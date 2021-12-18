<template>
  <q-table
    :loading="isLoading"
    title="Users"
    :rows="result && result.users ? result.users.data : []"
    :columns="columns"
    row-key="id"
  >
    <template v-slot:top-right class="q-gutter-md">
      <div class="flex content-center" style="gap: 15px;">
        <q-input
          outlined
          dense
          clearable
          label="Search"
          v-model="filterSearch"
        />
        <q-select
          outlined
          dense
          clearable
          style="min-width: 160px;"
          v-model="filterRole"
          :options="roleOptions"
          label="User Role"
        />
        <q-btn
          no-wrap
          color="primary"
          icon-right="add"
          label="Create User"
          @click="createUser"
        />
      </div>
    </template>
    <template v-slot:body-cell-buttons="props">
      <q-td :props="props">
        <q-btn-dropdown color="secondary" label="Action">
          <q-list>
            <q-item clickable v-close-popup @click="editUser(+props.value)">
              <q-item-section>
                <q-item-label>
                  Edit
                </q-item-label>
              </q-item-section>
            </q-item>
            <q-item clickable v-close-popup @click="deleteUser(props.row)">
              <q-item-section>
                <q-item-label class="text-red">
                  Delete
                </q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-td>
    </template>
  </q-table>
  <CreateUserDialog ref="createUserDialog" />
  <EditUserDialog v-if="editUserId" :user-id="editUserId" ref="editUserDialog" />
</template>

<script>
import { useQuery, useQueryLoading } from '@vue/apollo-composable';
import { defineComponent, nextTick, ref } from 'vue';
import { format, useQuasar } from 'quasar';
import { getUsers } from 'src/graphql/getUsers';
import CreateUserDialog from 'components/dialogs/CreateUserDialog';
import EditUserDialog from 'components/dialogs/EditUserDialog';
import { roleOptions } from 'src/const/userRoles';

const columns = [
  {
    name: 'id',
    required: true,
    label: 'ID',
    align: 'left',
    field: (row) => row.id,
    sortable: true,
  },
  {
    name: 'name',
    label: 'Name',
    align: 'left',
    field: (row) => row.name,
    sortable: true,
  },
  {
    name: 'email',
    label: 'Email',
    align: 'left',
    field: (row) => row.email,
  },
  {
    name: 'time_zone',
    label: 'Timezone',
    align: 'left',
    field: (row) => row.time_zone,
  },
  {
    name: 'created_at',
    label: 'Created',
    align: 'left',
    field: (row) => row.created_at,
    sortable: true,
  },
  {
    name: 'updated_at',
    label: 'Updated',
    align: 'left',
    field: (row) => row.updated_at,
    sortable: true,
  },
  {
    name: 'role',
    label: 'Role',
    align: 'left',
    field: (row) => format.capitalize(row.role),
    sortable: true,
  },
  {
    name: 'buttons',
    label: 'Actions',
    field: (row) => row.id,
  },
];

export default defineComponent({
  name: 'UsersTable',
  components: {
    CreateUserDialog,
    EditUserDialog,
  },
  setup() {
    const { result } = useQuery(getUsers, {
      first: 100,
      page: 1,
    });
    const isLoading = useQueryLoading();
    const $q = useQuasar();
    const createUserDialog = ref(null);
    const editUserDialog = ref(null);
    const filterRole = ref(null);
    const filterSearch = ref(null);
    const editUserId = ref(null);

    return {
      filterRole,
      filterSearch,
      roleOptions,
      createUserDialog,
      editUserDialog,
      result,
      columns,
      isLoading,
      editUserId,
      createUser() {
        createUserDialog.value.dialog.show();
      },
      deleteUser(user) {
        $q.dialog({
          title: `Delete User ${user.name || user.email}`,
          message: `Do you really want to delete user ${user.name || user.email}?`,
          cancel: true,
          persistent: true,
        })
          .onOk(() => {
            // TODO: add delete user request
            $q.notify({
              type: 'positive',
              message: `User #${user.id} has been deleted`,
            });
          });
      },
      editUser(id) {
        editUserId.value = +id;
        nextTick(() => {
          editUserDialog.value.dialog.show();
        });
      },
    };
  },
});
</script>
