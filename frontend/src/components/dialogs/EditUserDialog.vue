<template>
  <q-dialog
    ref="dialog"
    v-model="isActive"
  >
    <q-card style="width: 500px; max-width: 100%;" class="q-pa-md">
      <template v-if="isLoading">
        <div class="text-center">
          <q-spinner size="64" />
        </div>
      </template>
      <template v-else-if="error">
        <div class="text-center text-red">
          Error: {{ error.message }}
        </div>
      </template>
      <template v-else-if="user">
        <h3 class="font text-h5 q-mt-none">Edit User #{{ user.id }}</h3>
        <q-form @submit="onSubmit">
          <input type="hidden" name="id" v-model="user.id">
          <q-input
            class="q-mb-md"
            outlined
            hide-bottom-space
            v-model="userModel.name"
            autocomplete="name"
            label="Name"
            :rules="[
              val => !!val || 'Name field if required',
              val => val.length > 2 || 'Please use minimum 3 characters',
            ]"
          />
          <q-input
            class="q-mb-md"
            hide-bottom-space
            outlined
            type="email"
            autocomplete="email"
            v-model="userModel.email"
            :rules="[
              val => !!val || 'Email field if required'
            ]"
            label="Email"
          />
          <TimezoneInput
            class="q-mb-md"
            hide-bottom-space
            outlined
            label="Timezone"
            :rules="[
            val => !!val || 'Timezone field is required'
          ]"
            v-model="userModel.timezone"
          />
          <q-select
            class="q-mb-md"
            outlined
            hide-bottom-space
            v-model="userModel.role"
            :options="roleOptions"
            label="Role"
            :rules="[
              val => !!val || 'Role field is required'
            ]"
          />
          <FormErrors
            :error="submitUserError"
            class="text-red text-center q-my-md"
          />
          <div class="row justify-between">
            <q-btn label="Cancel" @click="hide()" />
            <q-btn label="Save" color="primary" type="submit" :loading="isSubmittingUser" />
          </div>
        </q-form>
      </template>
    </q-card>
  </q-dialog>
</template>
<script>
import { useQuasar } from 'quasar';
import {
  defineComponent, toRefs, ref, watch,
} from 'vue';
import { roleOptions } from 'src/const/userRoles';
import {
  useQuery, useResult, useQueryLoading, useMutation,
} from '@vue/apollo-composable';
import { getUserById } from 'src/graphql/getUser';
import FormErrors from 'components/misc/FormErrors';
import TimezoneInput from 'components/inputs/TimezoneInput';
import defaultUserModel from 'src/const/defaultUserModel';
import { editUser } from 'src/graphql/editUser';

export default defineComponent({
  name: 'EditUserDialog',
  components: { FormErrors, TimezoneInput },
  emits: ['save'],
  props: {
    userId: {
      type: Number,
      default: null,
      required: true,
    },
  },
  setup(props, { emit }) {
    const { userId } = toRefs(props);
    const {
      result, error, onResult, refetch,
    } = useQuery(getUserById, {
      id: userId,
    });
    const user = useResult(result, null, (data) => data.user);
    const isLoading = useQueryLoading();
    const $q = useQuasar();
    const isActive = ref(false);
    const dialog = ref(null);
    const userModel = ref(JSON.parse(JSON.stringify(defaultUserModel)));

    const {
      mutate: submitUser,
      loading: isSubmittingUser,
      error: submitUserError,
      onDone: submitUserOnDone,
    } = useMutation(editUser);

    submitUserOnDone(() => {
      emit('save');
      isActive.value = false;
      $q.notify({
        color: 'green-4',
        textColor: 'white',
        icon: 'cloud_done',
        message: 'User Saved',
      });
    });

    const updateModel = (res) => {
      if (!res.data || !res.data.user) {
        return;
      }
      userModel.value.id = +res.data.user.id;
      userModel.value.name = res.data.user.name;
      userModel.value.email = res.data.user.email;
      userModel.value.timezone = res.data.user.timezone;
      userModel.value.role = roleOptions.find((option) => option.value === res.data.user.role);
    };

    watch(isActive, () => {
      if (isActive.value) {
        userModel.value = JSON.parse(JSON.stringify(defaultUserModel));
        refetch().then((queryResult) => {
          updateModel(queryResult);
        });
      }
    });

    onResult((queryResult) => {
      updateModel(queryResult);
    });

    const onSubmit = () => {
      submitUser({
        id: userModel.value.id,
        name: userModel.value.name,
        email: userModel.value.email,
        timezone: userModel.value.timezone.value,
        role: userModel.value.role.value,
      });
    };

    return {
      user,
      isLoading,
      error,
      roleOptions,
      dialog,
      isActive,
      show() {
        isActive.value = true;
      },
      hide() {
        isActive.value = false;
      },
      userModel,
      submitUserError,
      isSubmittingUser,
      onSubmit,
    };
  },
});
</script>
