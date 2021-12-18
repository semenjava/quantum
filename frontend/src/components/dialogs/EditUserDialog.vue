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
          <div class="row justify-between">
            <q-btn label="Cancel" @click="hide()" />
            <q-btn label="Save" color="primary" type="submit" />
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
import { useQuery, useResult, useQueryLoading } from '@vue/apollo-composable';
import { getUserById } from 'src/graphql/getUser';

const defaultUserModel = {
  name: '',
  email: '',
  role: '',
};

export default defineComponent({
  name: 'EditUserDialog',
  props: {
    userId: {
      type: Number,
      default: null,
      required: true,
    },
  },
  setup(props) {
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

    const updateModel = (res) => {
      if (!res.data || !res.data.user) {
        return;
      }
      userModel.value.name = res.data.user.name;
      userModel.value.email = res.data.user.email;
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
      onSubmit() {
        isActive.value = false;
        $q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Submitted',
        });
      },
    };
  },
});
</script>
