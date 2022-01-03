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
import { timezoneOptions } from 'src/const/timezones';

export default defineComponent({
  name: 'TimezoneInput',
  setup() {
    const options = ref(timezoneOptions);
    const filterFn = (val, update) => {
      if (val === '') {
        update(() => {
          options.value = timezoneOptions;
        });
        return;
      }

      update(() => {
        const needle = val.toLowerCase();
        options.value = timezoneOptions.filter((o) => o.label.toLowerCase().indexOf(needle) > -1);
      });
    };

    return {
      options,
      filterFn,
    };
  },
});
</script>
