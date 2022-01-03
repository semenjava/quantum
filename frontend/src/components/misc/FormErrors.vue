<template>
  <div v-if="e">
    <div>{{ e.message }}</div>
    <template v-if="e.graphQLErrors">
      <div v-for="(e, index) in e.graphQLErrors" :key="index">
        <div v-if="e.debugMessage">
          {{ e.debugMessage }}
        </div>
        <div v-if="e.extensions && e.extensions.validation">
          <div v-for="(error, fieldName) in e.extensions.validation" :key="fieldName">
            {{ capitalize(fieldName) }}: {{ error.join(' ') }}
          </div>
        </div>
      </div>
    </template>
  </div>
</template>
<script>
import { format } from 'quasar';
import { defineComponent, toRefs } from 'vue';

export default defineComponent({
  name: 'FormErrors',
  props: {
    error: {
      type: Error,
      default: null,
      required: false,
    },
  },
  setup(props) {
    const { error } = toRefs(props);
    return {
      e: error,
      capitalize: format.capitalize,
    };
  },
});
</script>
