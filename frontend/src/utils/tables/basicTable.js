import { extend } from 'quasar';
import { ref } from 'vue';
import { useQuery, useResult } from '@vue/apollo-composable';

/**
 * Basic table component utility
 *
 * @param {Object} tableOptions Table options
 * @param {string} tableOptions.sortBy Field name of default sort.
 * @param {boolean} tableOptions.descending Descending or ASC.
 * @param {number} tableOptions.rowsPerPage Number of rows per page by default.
 * @param tableOptions.tableQuery The name of the user.
 * @param tableOptions.tableRef The ref of q-table
 */
export const basicTable = (tableOptions) => {
  const options = extend(true, {
    sortBy: 'id',
    descending: true,
    rowsPerPage: 5,
    tableQuery: null,
    tableRef: null,
  }, tableOptions);

  if (!options.tableQuery) {
    throw new Error('No tableQuery provided for basicTable');
  }

  if (!options.tableRef) {
    throw new Error('No tableRef provided for basicTable');
  }

  const pagination = ref({
    sortBy: options.sortBy,
    descending: options.descending,
    rowsPerPage: options.rowsPerPage,
    page: 0,
    rowsNumber: 0,
  });

  const filter = ref({
    search: '',
    archived: false,
  });

  const {
    result, fetchMore, onResult, error, loading, refetch,
  } = useQuery(options.tableQuery, {
    test: Math.random(),
    first: pagination.value.rowsPerPage,
    page: pagination.value.page,
    search: filter.value.search || '',
    sort: {
      value: {
        column: pagination.value.sortBy,
        order: pagination.value.descending ? 'DESC' : 'ASC',
      },
    },
    archived: filter.value.archived,
  }, {

  });

  const dataResult = useResult(result);

  onResult(() => {
    pagination.value.rowsNumber = dataResult.value.paginatorInfo.total;
  });

  const requestEvent = async (req) => {
    const refetchRes = await refetch({
      first: req.pagination.rowsPerPage,
      page: req.pagination.page,
      search: req.filter.search || '',
      sort: {
        value: {
          column: req.pagination.sortBy || 'id',
          order: req.pagination.descending ? 'DESC' : 'ASC',
        },
      },
      archived: req.filter.archived,
    });

    const res = refetchRes.data[Object.keys(refetchRes.data)[0]];

    pagination.value.page = res.paginatorInfo.currentPage;
    pagination.value.rowsPerPage = res.paginatorInfo.perPage;
    pagination.value.rowsNumber = res.paginatorInfo.total;
    pagination.value.sortBy = req.pagination.sortBy;
    pagination.value.descending = req.pagination.descending;
  };

  const resetTable = () => {
    filter.value.search = '';
    filter.value.archived = false;
    pagination.value.sortBy = options.sortBy;
    pagination.value.descending = true;
    pagination.value.page = 0;
    pagination.value.rowsPerPage = options.rowsPerPage;
    pagination.value.rowsNumber = 0;
    options.tableRef.value.requestServerInteraction();
  };

  return {
    requestEvent,
    resetTable,
    result,
    fetchMore,
    onResult,
    pagination,
    filter,
    error,
    loading,
  };
};
