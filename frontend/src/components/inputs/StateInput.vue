<template>
  <q-select
    v-bind="{...$props, ...$attrs}"
    use-input
    :options="options"
    @filter="filterFn"
  />
</template>
<script>
import { defineComponent, ref } from 'vue';
import states from 'src/const/usStates';

export default defineComponent({
  name: 'StateInput',
  setup() {
    const options = ref(states);
    const filterFn = (val, update) => {
      if (val === '') {
        update(() => {
          options.value = states;
        });
        return;
      }

      update(() => {
        const needle = val.toLowerCase();
        options.value = states.filter((o) => o.toLowerCase().indexOf(needle) > -1);
      });
    };

    return {
      options,
      filterFn,
    };
  },
});
</script>
