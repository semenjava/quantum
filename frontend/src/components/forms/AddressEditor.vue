<template>
  <div v-if="addresses.length === 0" class="q-mb-md">
    No addresses specified
  </div>
  <div v-for="(address, index) in addresses" :key="index">
    <div class="row q-col-gutter-md q-mb-md">
      <div class="col-12 col-lg-11">
        <div class="row q-col-gutter-md q-mb-md">
          <div class="col-12 col-lg-4">
            <q-input
              outlined
              hide-bottom-space
              dense
              v-model="address.address1"
              label="Address Line 1"
              :rules="[ val => (val.length === 0 || val.length > 2) || 'Please fill address field']"
            />
          </div>
          <div class="col-12 col-lg-4">
            <q-input outlined hide-bottom-space dense v-model="address.city" label="City" />
          </div>
          <div class="col-12 col-lg-4">
            <StateInput outlined dense hide-bottom-space v-model="address.state" label="State" />
          </div>
        </div>
        <div class="row q-col-gutter-md">
          <div class="col-12 col-lg-4">
            <q-input outlined hide-bottom-space dense v-model="address.address2" label="Address Line 2" />
          </div>
          <div class="col-12 col-lg-4">
            <q-input
              type="number"
              outlined
              hide-bottom-space
              dense
              v-model="address.postalCode"
              label="Postal Code"
              :rules="[ val => val.length === 5 || 'Please use 5 digits code']"
            />
          </div>
          <div class="col-12 col-lg-4">
            <div class="row q-col-gutter-xs">
              <div class="col-12">
                Address Type
              </div>
              <div class="col-4">
                <q-checkbox dense v-model="address.postalAddress" label="Postal Address" />
              </div>
              <div class="col-4">
                <q-checkbox dense v-model="address.billingAddress" label="Billing Address" />
              </div>
              <div class="col-4">
                <q-checkbox dense v-model="address.officeAddress" label="Office Address" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-1">
        <q-btn icon="delete" round color="red" dense @click.prevent="deleteAddress(index)"></q-btn>
      </div>
    </div>
    <q-separator v-if="index !== addresses.length - 1" class="q-mb-md" />
  </div>
  <div v-if="showErrors && errors.length" class="q-mb-md text-red">
    Errors: {{ errors.join(', ') }}
  </div>
  <div class="row justify-between">
    <q-btn
      label="Save"
      color="secondary"
      @click.prevent="save(entityType, entityId)"
    >
    </q-btn>
    <q-btn
      :disabled="(entityType === 'employee' && addresses.length > 0) || addresses.length > 2"
      label="Add address"
      color="primary"
      @click.prevent="addAddress"
    ></q-btn>
  </div>
</template>
<script>
import {
  defineComponent, ref, watch,
} from 'vue';
import defaultAddressModel from 'src/const/defaultAddressModel';
import StateInput from 'components/inputs/StateInput';

const addresses = ref([]);
const showErrors = ref(false);
const errors = ref([]);

const addAddress = () => {
  addresses.value.push(JSON.parse(JSON.stringify(defaultAddressModel)));
};

const deleteAddress = (i) => {
  addresses.value.splice(i, 1);
};

const validate = (entityType) => {
  errors.value = [];
  // Validate first
  // Companies, facilities and providers can have:
  // 0 or 1 postal address
  // 0 or 1 billing address
  // 0 or 1 office address
  if (['company', 'facility', 'provider'].includes(entityType)) {
    if (addresses.value.filter((a) => a.postalAddress).length > 1) {
      errors.value.push('Only one postal address is allowed');
    }
    if (addresses.value.filter((a) => a.billingAddress).length > 1) {
      errors.value.push('Only one billing address is allowed');
    }
    if (addresses.value.filter((a) => a.officeAddress).length > 1) {
      errors.value.push('Only one office address is allowed');
    }
  }
  if (
    addresses.value.length > 1
    && addresses.value.filter((a) => !a.postalAddress && !a.billingAddress && !a.officeAddress).length
  ) {
    errors.value.push('Address type should not be empty');
  }

  return errors.value.length <= 0;
};

const save = (entityType, entityId) => {
  showErrors.value = true;
  if (validate(entityType)) {
    console.log(entityType, entityId);
  }
};

export default defineComponent({
  name: 'AddressEditor',
  components: {
    StateInput,
  },
  props: {
    entityType: {
      type: String,
      default: null,
      validator(value) {
        return ['company', 'facility', 'provider', 'employee'].includes(value);
      },
      required: true,
    },
    entityId: {
      type: Number,
      default: null,
      required: true,
    },
  },
  setup(props) {
    watch(addresses, () => {
      // If only one address is present it should be postal, billing and office address
      if (addresses.value.length === 1) {
        addresses.value.forEach((address) => {
          address.postalAddress = true;
          address.billingAddress = true;
          address.officeAddress = true;
        });
      }
      validate(props.entityType);
    }, {
      deep: true,
    });

    return {
      addresses,
      addAddress,
      deleteAddress,
      save,
      errors,
      showErrors,
    };
  },
});
</script>
