<template>
  <div v-if="addresses.length === 0 && !isLoading" class="q-mb-md">
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
              v-model="address.address_line_1"
              label="Address Line 1"
              :rules="[ val => val.length > 2 || 'Please fill address field']"
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
            <q-input outlined hide-bottom-space dense v-model="address.address_line_2" label="Address Line 2" />
          </div>
          <div class="col-12 col-lg-4">
            <q-input
              type="number"
              outlined
              hide-bottom-space
              dense
              v-model="address.postal"
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
                <q-checkbox dense v-model="address.postal_address" label="Postal Address" />
              </div>
              <div class="col-4">
                <q-checkbox dense v-model="address.billing_address" label="Billing Address" />
              </div>
              <div class="col-4">
                <q-checkbox dense v-model="address.office_address" label="Office Address" />
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
  <div v-if="showErrors && validationErrors.length" class="q-mb-md text-red">
    Errors: {{ validationErrors.join(', ') }}
  </div>
  <FormErrors
    :error="submitError"
    class="q-mb-md text-red"
  />
  <div class="row justify-between">
    <q-btn
      label="Save"
      :loading="isSubmitting || isLoading"
      color="secondary"
      @click.prevent="save()"
    >
    </q-btn>
    <q-btn
      :disabled="(entityType === 'employee' && addresses.length > 0) || addresses.length > 2"
      :loading="isSubmitting || isLoading"
      label="Add address"
      color="primary"
      @click.prevent="addAddress"
    ></q-btn>
  </div>
</template>
<script>
import {
  defineComponent, ref, toRefs, watch, onMounted,
} from 'vue';
import defaultAddressModel from 'src/const/defaultAddressModel';
import StateInput from 'components/inputs/StateInput';
import { useQuery, useMutation } from '@vue/apollo-composable';
import { getAddresses } from 'src/graphql/getAddresses';
import { storeProviderAddresses } from 'src/graphql/storeAddresses';
import FormErrors from 'components/misc/FormErrors';
import { useQuasar } from 'quasar';

const addresses = ref([]);
const showErrors = ref(false);
const submitError = ref(null);
const validationErrors = ref([]);
const isLoading = ref(false);
const isSubmitting = ref(false);

const addAddress = () => {
  addresses.value.push(JSON.parse(JSON.stringify(defaultAddressModel)));
};

const deleteAddress = (i) => {
  addresses.value.splice(i, 1);
};

const validate = (entityType) => {
  validationErrors.value = [];
  // Validate first
  // Companies, facilities and providers can have:
  // 0 or 1 postal address
  // 0 or 1 billing address
  // 0 or 1 office address
  if (['company', 'facility', 'provider'].includes(entityType)) {
    if (addresses.value.filter((a) => a.postal_address).length > 1) {
      validationErrors.value.push('Only one postal address is allowed');
    }
    if (addresses.value.filter((a) => a.billing_address).length > 1) {
      validationErrors.value.push('Only one billing address is allowed');
    }
    if (addresses.value.filter((a) => a.office_address).length > 1) {
      validationErrors.value.push('Only one office address is allowed');
    }
  }
  if (
    addresses.value.length > 1
    && addresses.value.filter((a) => !a.postal_address && !a.billing_address && !a.office_address).length
  ) {
    validationErrors.value.push('Address type should not be empty');
  }

  return validationErrors.value.length <= 0;
};

export default defineComponent({
  name: 'AddressEditor',
  components: {
    FormErrors,
    StateInput,
  },
  emits: ['save', 'error'],
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
  setup(props, { emit }) {
    const $q = useQuasar();
    const { entityId, entityType } = toRefs(props);
    const fetchAddresses = () => {
      isLoading.value = true;
      const queryVariables = {};
      queryVariables[`${entityType.value}_id`] = entityId.value;
      const { onResult, onError } = useQuery(getAddresses, queryVariables);

      onResult((res) => {
        if (res.data && res.data.getAddresses) {
          addresses.value = JSON.parse(JSON.stringify(res.data.getAddresses));
        }
        isLoading.value = false;
      });

      onError((e) => {
        $q.notify({
          message: `Error fetching addresses: ${e.message}`,
          type: 'negative',
        });
        isLoading.value = false;
      });
    };

    onMounted(fetchAddresses);

    const save = async () => {
      showErrors.value = true;
      submitError.value = null;
      if (!validate(entityType)) {
        return false;
      }
      isLoading.value = true;

      const {
        mutate: saveMutate,
        onError: onSaveError,
        onDone: onSaveDone,
      } = useMutation(storeProviderAddresses);

      onSaveError((e) => {
        submitError.value = e;
        isLoading.value = false;
        emit('error', e);
        return false;
      });

      onSaveDone(() => {
        $q.notify({
          message: 'Addresses saved',
          type: 'positive',
        });
        isLoading.value = false;
      });

      const addressesVariable = {
        addresses: addresses.value.map((address) => {
          const variable = {
            address_line_1: address.address_line_1,
            address_line_2: address.address_line_2,
            city: address.city,
            postal: address.postal,
            state: address.state,
            postal_address: address.postal_address,
            billing_address: address.billing_address,
            office_address: address.office_address,
          };
          variable[`${entityType.value}_id`] = entityId.value;

          return variable;
        }),
      };

      await saveMutate(addressesVariable);

      emit('save');

      return true;
    };

    watch(addresses, () => {
      // If only one address is present it should be postal, billing and office address
      if (addresses.value.length === 1) {
        addresses.value.forEach((address) => {
          address.postal_address = true;
          address.billing_address = true;
          address.office_address = true;
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
      validationErrors,
      showErrors,
      submitError,
      isLoading,
      isSubmitting,
    };
  },
});
</script>
