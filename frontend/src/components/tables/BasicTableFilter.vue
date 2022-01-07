<template>
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
  <q-select
    v-if="columns"
    v-model="filter.visibleColumns"
    multiple
    outlined
    dense
    options-dense
    :display-value="$q.lang.table.columns"
    emit-value
    map-options
    :options="columns"
    option-value="name"
    options-cover
    style="min-width: 150px"
  />
</template>
<script>
import { useModelWrapper } from 'src/utils/modelWrapper';
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    modelValue: {
      type: Object,
      default() {
        return {
          archived: false,
          search: null,
        };
      },
    },
    columns: {
      type: Array,
      default() {
        return [];
      },
      required: false,
    },
  },
  setup(props, { emit }) {
    return {
      filter: useModelWrapper(props, emit, 'modelValue'),
    };
  },
});
</script>
