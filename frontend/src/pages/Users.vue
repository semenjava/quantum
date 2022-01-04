<template>
  <q-page class="q-pa-lg bg-grey-3">
    <UsersTable />
    <q-card class="q-mt-lg">
      <q-card-section>
        <div class="q-mb-md">
          Address Editor for Provider id: 1
        </div>
        <AddressEditor entity-type="provider" :entity-id="1" />
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
