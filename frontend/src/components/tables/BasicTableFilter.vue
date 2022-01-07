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
  },
  setup(props, { emit }) {
    return {
      filter: useModelWrapper(props, emit, 'modelValue'),
    };
  },
});
</script>
