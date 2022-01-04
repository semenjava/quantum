<template>
  <q-page class="q-pa-lg bg-grey-3">
    <UsersTable />
    <q-card class="q-mt-lg">
      <q-card-section>
        <AddressEditor />
      </q-card-section>
    </q-card>
  </q-page>
</template>
<script>
import { defineComponent } from 'vue';
import UsersTable from 'components/tables/UsersTable';
import AddressEditor from 'components/forms/AddressEditor';

export default defineComponent({
  name: 'UsersPage',
  components: {
    UsersTable,
    AddressEditor,
  },
});
</script>
