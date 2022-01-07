<template>
  <div>
    <q-banner v-if="error" dense inline-actions rounded class="text-white bg-red q-mb-md">
      {{ error }}
    </q-banner>
    <q-table
      ref="table"
      :loading="isLoading"
      title="Users"
      :rows="result && result.users ? result.users.data : []"
      :columns="columns"
      :filter="filter"
      :dense="$q.screen.lt.md"
      v-model:pagination="pagination"
      :rows-per-page-options="[2, 50, 100]"
      @request="requestEvent"
      row-key="id"
    >
      <template v-slot:top-right class="q-gutter-md">
        <div class="flex content-center" style="gap: 15px;">
          <q-toggle
            label="Show Archived"
            v-model="filter.archived"
          />
          <q-input
            outlined
            dense
            clearable
            label="Search"
            v-model="filter.search"
            debounce="1000"
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
      <template v-slot:body-cell-email="props">
        <q-td :props="props">
          <a :href="'mailto:' + props.value">
            {{ props.value }}
          </a>
        </q-td>
      </template>
      <template v-slot:body-cell-created_at="props">
        <q-td :props="props">
          <div>
            {{ currentUserTimezoneDate(props.value) }}
            <q-tooltip>
              UTC: {{ UTCtimezoneDate(props.value) }}
            </q-tooltip>
          </div>
        </q-td>
      </template>
      <template v-slot:body-cell-updated_at="props">
        <q-td :props="props">
          {{ currentUserTimezoneDate(props.value) }}
          <q-tooltip>
            UTC: {{ UTCtimezoneDate(props.value) }}
          </q-tooltip>
        </q-td>
      </template>
      <template v-slot:body-cell-buttons="cell">
        <ActionsTableCell :cell="cell" :actions="tableActions" class="text-right" />
      </template>
    </q-table>
    <CreateUserDialog ref="createUserDialog" @save="resetTable" />
    <EditUserDialog v-if="editUserId" :user-id="editUserId" ref="editUserDialog" @save="resetTable" />
  </div>
</template>

<script>
import { useMutation } from '@vue/apollo-composable';
import {
  defineComponent, nextTick, ref,
} from 'vue';
import { format, useQuasar } from 'quasar';
import { getUsers } from 'src/graphql/getUsers';
import { deleteUser } from 'src/graphql/deleteUser';
import { currentUserTimezoneDate, UTCtimezoneDate } from 'src/utils/dateFormat';
import ActionsTableCell from 'components/tables/ActionsTableCell';
import CreateUserDialog from 'components/dialogs/CreateUserDialog';
import EditUserDialog from 'components/dialogs/EditUserDialog';
import { roleOptions } from 'src/const/userRoles';
import { basicTable } from 'src/utils/tables/basicTable';

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
    ActionsTableCell,
    CreateUserDialog,
    EditUserDialog,
  },
  setup() {
    const $q = useQuasar();
    const table = ref(null);
    const createUserDialog = ref(null);
    const editUserDialog = ref(null);
    const editUserId = ref(null);

    const bTable = basicTable({
      rowsPerPage: 5,
      tableQuery: getUsers,
      tableRef: table,
    });

    const { mutate: deleteUserMutate, onDone: deleteUserOnDone } = useMutation(deleteUser);
    const deleteUserAction = (cell) => {
      const userId = +cell.value;
      $q.dialog({
        title: `Delete User #${userId}`,
        message: `Do you really want to delete user #${userId}?`,
        cancel: true,
        persistent: true,
      })
        .onOk(() => {
          deleteUserMutate({
            id: userId,
          });
        });
    };

    deleteUserOnDone(() => {
      $q.notify({
        type: 'positive',
        message: 'User has been deleted',
      });
      bTable.resetTable();
    });

    const editUserAction = (user) => {
      editUserId.value = +user.value;
      nextTick(() => {
        editUserDialog.value.dialog.show();
      });
    };

    const tableActions = [
      {
        label: 'Edit',
        icon: 'edit',
        color: 'primary',
        action: editUserAction,
      },
      {
        label: 'Delete',
        icon: 'delete',
        color: 'negative',
        action: deleteUserAction,
      },
    ];

    const createUser = () => {
      createUserDialog.value.dialog.show();
    };

    return {
      ...bTable,

      roleOptions,
      createUserDialog,
      editUserDialog,
      columns,
      editUserId,
      createUser,
      tableActions,
      table,
      currentUserTimezoneDate,
      UTCtimezoneDate,
    };
  },
});
</script>
