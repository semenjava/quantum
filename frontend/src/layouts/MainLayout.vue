<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn flat @click="toggleLeftDrawer" round dense icon="menu" />
        <q-toolbar-title>
          {{ pageHeaderTitle }}
        </q-toolbar-title>

        <q-btn-dropdown color="secondary" :label="userName">
          <q-list>
            <q-item clickable v-close-popup>
              <q-item-section>
                <q-item-label>Settings</q-item-label>
              </q-item-section>
            </q-item>
            <q-item clickable v-close-popup @click="openProfile">
              <q-item-section>
                <q-item-label>Profile</q-item-label>
              </q-item-section>
            </q-item>
            <q-item clickable v-close-popup @click="logout">
              <q-item-section>
                <q-item-label>Logout</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-input dense class="q-mx-md q-my-sm" outlined label="Search" />
      <q-list>
        <SidebarMenuItem
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
const linksList = [
  {
    type: 'label',
    title: 'Cases',
  },
  {
    type: 'link',
    title: 'Cases',
    icon: 'people_alt',
    link: '/cases',
  },
  {
    type: 'link',
    title: 'Authorizations',
    icon: 'task',
    link: '/cases/authorizations',
  },
  {
    type: 'link',
    title: 'Ongoing Treatment Reports',
    icon: 'receipt_long',
    link: '/cases/ongoing-treatment-report',
  },
  {
    type: 'link',
    title: 'Claims',
    icon: 'record_voice_over',
    link: '/cases/claims',
  },
  {
    type: 'separator',
  },
  {
    type: 'label',
    title: 'Providers',
  },
  {
    type: 'link',
    title: 'Providers',
    icon: 'volunteer_activism',
    link: '/providers',
  },
  {
    type: 'link',
    title: 'Facilities',
    icon: 'business',
    link: '/providers/facilities',
  },
  {
    type: 'separator',
  },
  {
    type: 'link',
    title: 'Notifications',
    icon: 'notifications',
    link: '/notifications',
  },
  {
    type: 'link',
    title: 'Reporting',
    icon: 'summarize',
    link: '/reporting',
  },
];

const adminLinksList = [
  {
    type: 'separator',
  },
  {
    type: 'label',
    title: 'Admin',
  },
  {
    type: 'link',
    title: 'Users',
    icon: 'people',
    link: '/admin/users',
  },
  {
    type: 'link',
    title: 'Value lists',
    icon: 'people',
    link: '/admin/value-lists',
  },
  {
    type: 'link',
    title: 'Text snippets',
    icon: 'people',
    link: '/admin/text-snippets',
  },
  {
    type: 'link',
    title: 'Communication Templates',
    icon: 'people',
    link: '/admin/communication-templates',
  },
];

import { defineComponent, ref, watch } from 'vue';
import SidebarMenuItem from 'components/SidebarMenuItem';
import { useStore } from 'vuex';
import { useRouter, useRoute } from 'vue-router';
import { useQuasar } from 'quasar';

export default defineComponent({
  name: 'MainLayout',

  components: {
    SidebarMenuItem,
  },

  setup() {
    const $q = useQuasar();
    const $store = useStore();
    const $router = useRouter();
    const $route = useRoute();
    const leftDrawerOpen = ref(false);
    const userName = $store.getters['app/user'].name;
    const pageHeaderTitle = ref('Quantum Health Connect');
    if ($route.meta && $route.meta.title) {
      pageHeaderTitle.value = $route.meta.title;
    }

    watch(
      () => $route.path,
      () => {
        pageHeaderTitle.value = $route.meta.title ? $route.meta.title : 'Quantum Health Connect';
      },
    );

    return {
      essentialLinks: [...linksList, ...($store.getters['app/isAdmin'] ? adminLinksList : [])],
      leftDrawerOpen,
      pageHeaderTitle,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
      userName,
      openProfile() {},
      async logout() {
        $q.loading.show({
          message: 'Logging out',
        });
        await $store.dispatch('app/logout');
        $router.push({ name: 'login' });
        $q.loading.hide();
      },
    };
  },
});
</script>
