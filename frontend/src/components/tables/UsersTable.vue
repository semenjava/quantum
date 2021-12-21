<template>
  <q-table
    ref="table"
    :loading="isLoading"
    title="Users"
    :rows="result && result.users ? result.users.data : []"
    :columns="columns"
    :filter="filter"
    v-model:pagination="pagination"
    :rows-per-page-options="[2, 50, 100]"
    @request="requestEvent"
    row-key="id"
  >
    <template v-slot:top-right class="q-gutter-md">
      <div class="flex content-center" style="gap: 15px;">
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
  <CreateUserDialog ref="createUserDialog" @save="resetTable" />
  <EditUserDialog v-if="editUserId" :user-id="editUserId" ref="editUserDialog" @save="resetTable" />
</template>

<script>
import { useQuery, useQueryLoading } from '@vue/apollo-composable';
import {
  defineComponent, nextTick, ref,
} from 'vue';
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
    name: 'timezone',
    label: 'Timezone',
    align: 'left',
    field: (row) => row.timezone,
  },
  {
    name: 'createdAt',
    label: 'Created',
    align: 'left',
    field: (row) => row.createdAt,
    sortable: true,
  },
  {
    name: 'updatedAt',
    label: 'Updated',
    align: 'left',
    field: (row) => row.updatedAt,
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
    const isLoading = useQueryLoading();
    const $q = useQuasar();
    const table = ref(null);
    const createUserDialog = ref(null);
    const editUserDialog = ref(null);
    const editUserId = ref(null);
    const pagination = ref({
      sortBy: 'id',
      descending: true,
      page: 1,
      rowsPerPage: 5,
      rowsNumber: 10,
    });
    const filter = ref({
      search: null,
    });
    const resetTable = () => {
      filter.value.search = null;
      pagination.value.sortBy = 'id';
      pagination.value.descending = true;
      pagination.value.page = 1;
      pagination.value.rowsPerPage = 5;
      pagination.value.rowsNumber = 10;
      table.value.requestServerInteraction();
    };
    const { result, fetchMore } = useQuery(getUsers, {
      first: pagination.value.rowsPerPage,
      page: pagination.value.page,
      search: filter.value.search,
      sort: {
        value: {
          column: pagination.value.sortBy,
          order: pagination.value.descending ? 'DESC' : 'ASC',
        },
      },
    });
    const requestEvent = (req) => {
      fetchMore({
        variables: {
          first: req.pagination.rowsPerPage,
          page: req.pagination.page,
          // TODO: add search
          sort: {
            value: {
              column: req.pagination.sortBy || 'id',
              order: req.pagination.descending ? 'DESC' : 'ASC',
            },
          },
        },
        updateQuery: (prev, { fetchMoreResult }) => {
          pagination.value.page = fetchMoreResult.users.paginatorInfo.currentPage;
          pagination.value.rowsPerPage = fetchMoreResult.users.paginatorInfo.perPage;
          pagination.value.rowsNumber = 10;
          pagination.value.sortBy = req.pagination.sortBy;
          pagination.value.descending = req.pagination.descending;
          return fetchMoreResult;
        },
      });
    };
    const deleteUser = (user) => {
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
    };
    const editUser = (id) => {
      editUserId.value = +id;
      nextTick(() => {
        editUserDialog.value.dialog.show();
      });
    };
    const createUser = () => {
      createUserDialog.value.dialog.show();
    };

    return {
      filter,
      roleOptions,
      createUserDialog,
      editUserDialog,
      result,
      columns,
      isLoading,
      editUserId,
      createUser,
      deleteUser,
      editUser,
      pagination,
      requestEvent,
      table,
      resetTable,
    };
  },
});
</script>
