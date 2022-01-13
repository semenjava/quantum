import { route } from 'quasar/wrappers';
import {
  createRouter, createMemoryHistory, createWebHistory, createWebHashHistory,
} from 'vue-router';
import { productName } from '../../package.json';
import routes from './routes';

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Router instance.
 */

export default route(({ store }) => {
  const createHistory = process.env.SERVER
    ? createMemoryHistory
    : (process.env.VUE_ROUTER_MODE === 'history' ? createWebHistory : createWebHashHistory);

  const Router = createRouter({
    scrollBehavior: () => ({ left: 0, top: 0 }),
    routes,

    // Leave this as is and make changes in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    history: createHistory(process.env.MODE === 'ssr' ? void 0 : process.env.VUE_ROUTER_BASE),
  });

  Router.beforeEach(async (to, from, next) => {
    // Check if user is logged in while browsing non-public pages
    if (
      to.matched.some((record) => !record.meta || !record.meta.public)
      && !store.getters['app/isLoggedIn']
    ) {
      next({ name: 'login', query: { next: to.fullPath } });

    // Check if user is admin while browsing admin pages
    } else if (
      to.matched.some((record) => record.meta && record.meta.requiresAdmin)
      && !store.getters['app/isAdmin']
    ) {
      next({ name: 'forbidden' });

    // Check logged-in user token every time while browsing non-public pages
    } else if (
      to.matched.some((record) => !record.meta || !record.meta.public)
      && store.getters['app/isLoggedIn']
    ) {
      const check = await store.dispatch('app/checkUserToken');
      if (check) {
        next();
      } else {
        next({
          name: 'login',
          query: { next: to.fullPath },
          params: {
            messageText: 'Session expired, please login',
            messageType: 'negative',
          },
        });
      }
    } else {
      next();
    }
  });

  // Dynamic page titles
  Router.afterEach(async (to) => {
    if (to.meta && to.meta.title) {
      document.title = `${to.meta.title} | ${productName}`;
    } else {
      document.title = productName;
    }
  });

  return Router;
});
