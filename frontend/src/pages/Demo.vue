<template>
  <q-page class="q-pa-lg bg-grey-3">
    <q-card class="q-mt-lg">
      <q-card-section>
        <div class="q-mb-md">
          Address Editor for Provider id: 1
        </div>
        <AddressEditor entity-type="provider" :entity-id="1" />

        <div class="q-mt-md">
          <q-form>
            <PhoneInput v-model="phone" dense outlined name="phone" required />
            <q-btn type="submit" label="Submit" />
          </q-form>
        </div>
      </q-card-section>
    </q-card>
  </q-page>
</template>
<script>
import { defineComponent } from 'vue';
import AddressEditor from 'components/forms/AddressEditor';
import PhoneInput from 'components/inputs/PhoneInput';

export default defineComponent({
  name: 'DemoPage',
  components: {
    AddressEditor,
    PhoneInput,
  },
  data() {
    return {
      phone: null,
    };
  },
});
</script>
