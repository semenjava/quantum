<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn flat @click="toggleLeftDrawer" round dense icon="menu" />
        <q-toolbar-title>
          Quantum Health Connect
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-input class="q-ma-md" outlined label="Search" />
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

import { defineComponent, ref } from 'vue';
import SidebarMenuItem from 'components/SidebarMenuItem';

export default defineComponent({
  name: 'MainLayout',

  components: {
    SidebarMenuItem,
  },

  setup() {
    const leftDrawerOpen = ref(false);

    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
});
</script>
