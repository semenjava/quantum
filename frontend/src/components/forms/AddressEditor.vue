<template>
  <div v-for="(address, index) in addresses" :key="index">
    <div class="row q-col-gutter-md">
      <div class="col-4">
        <q-input
          outlined
          hide-bottom-space
          dense
          v-model="address.address1"
          label="Address Line 1"
          :rules="[ val => (val.length === 0 || val.length > 2) || 'Please fill address field']"
        />
      </div>
      <div class="col-3">
        <q-input outlined hide-bottom-space dense v-model="address.city" label="City" />
      </div>
      <div class="col-3">
        <StateInput class="q-mb-md" outlined dense hide-bottom-space v-model="address.state" label="State" />
      </div>
      <div class="col-2">
        <q-btn icon="delete" round color="red" dense @click.prevent="deleteAddress(index)"></q-btn>
      </div>
    </div>
    <div class="row q-col-gutter-md">
      <div class="col-4">
        <q-input class="q-mb-md" outlined hide-bottom-space dense v-model="address.address2" label="Address Line 2" />
      </div>
      <div class="col-3">
        <q-input
          type="number"
          class="q-mb-md"
          outlined
          hide-bottom-space
          dense
          v-model="address.postalCode"
          label="Postal Code"
          :rules="[ val => val.length === 5 || 'Please use 5 digits code']"
        />
      </div>
    </div>
  </div>
  <q-btn label="Add another address" color="primary" @click.prevent="addAddress"></q-btn>
</template>
<script>
import { defineComponent, ref } from 'vue';
import defaultAddressModel from 'src/const/defaultAddressModel';
import StateInput from 'components/inputs/StateInput';

const addresses = ref([]);

const addAddress = () => {
  addresses.value.push(JSON.parse(JSON.stringify(defaultAddressModel)));
};

const deleteAddress = (i) => {
  addresses.value.splice(i, 1);
};

export default defineComponent({
  name: 'AddressEditor',
  components: {
    StateInput,
  },
  props: {
    entityId: {
      type: Number,
      default: null,
      required: false,
    },
  },
  setup() {
    return {
      addresses,
      addAddress,
      deleteAddress,
    };
  },
});
</script>
