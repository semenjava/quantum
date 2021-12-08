const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: 'cases', component: () => import('pages/Cases.vue') },
      { path: 'cases/authorizations', component: () => import('pages/Authorizations.vue') },
      {
        path: '/admin',
        children: [
          {
            path: 'users',
            meta: { requiresAdmin: true },
            component: () => import('pages/Users.vue'),
          },
        ],
      },
      {
        name: 'forbidden',
        path: '/forbidden',
        component: () => import('pages/Forbidden.vue'),
      },
    ],
  },
  {
    path: '/login',
    meta: { public: true },
    component: () => import('layouts/Login.vue'),
    children: [
      {
        name: 'login',
        path: '',
        meta: { public: true },
        component: () => import('pages/Login.vue'),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
];

export default routes;
