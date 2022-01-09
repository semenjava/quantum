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
        <div v-if="e.trace">
          <div class="trace bg-amber-1 q-my-md q-px-md rounded-borders" :class="{ 'active': traceActive }">
            <div v-for="(trace, traceIndex) in e.trace" :key="traceIndex" class="q-mb-sm">
              <pre v-if="trace.file" class="q-my-xs">File: {{ trace.file }}</pre>
              <pre v-if="trace.line" class="q-my-xs">Line: {{ trace.line }}</pre>
              <pre v-if="trace.call" class="q-my-xs">Call: {{ trace.call }}</pre>
              <q-separator />
            </div>
          </div>
          <q-btn
            @click.prevent="traceActive = !traceActive"
            :icon="traceActive ? 'remove' : 'add'"
            :label="traceActive ? 'Collapse' : 'Expand'"
            color="red"
          />
        </div>
      </div>
    </template>
  </div>
</template>
<script>
import { format } from 'quasar';
import { defineComponent, ref, toRefs } from 'vue';

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
    const traceActive = ref(false);
    return {
      e: error,
      capitalize: format.capitalize,
      traceActive,
    };
  },
});
</script>
<style>
.trace {
  border: 1px solid red;
  max-height: 50px;
  overflow: auto;
}

.trace.active {
  max-height: 1000px;
}
</style>
