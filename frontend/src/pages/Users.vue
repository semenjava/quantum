<template>
  <q-page class="q-pa-lg bg-grey-3">
    <UsersTable />
  </q-page>
</template>
<script>
import { defineComponent } from 'vue';
import UsersTable from 'components/tables/UsersTable';

export default defineComponent({
  name: 'UsersPage',
  components: {
    UsersTable,
  },
});
</script>
