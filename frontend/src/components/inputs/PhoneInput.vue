<template>
 <q-input
   v-bind="{...$props, ...$attrs}"
   mask="phone"
   label="Phone"
   type="tel"
   prefix="+1"
   :rules="rules"
   lazy-rules
 />
</template>
<script>
import { defineComponent } from 'vue';

export default defineComponent({
  setup() {
    const rules = [
      (val) => val.length === 16 || 'Please fill up phone number correctly',
    ];
    return {
      rules,
    };
  },
});
</script>
