<template>
  <router-view />
</template>
<script>
import { defineComponent, provide } from 'vue';
import { DefaultApolloClient } from '@vue/apollo-composable';
import { apolloClient } from 'src/boot/vue-apollo';

export default defineComponent({
  name: 'App',
  setup() {
    provide(DefaultApolloClient, apolloClient);
  },
});
</script>
