<template>
  <q-dialog
    ref="dialog"
    v-model="isActive"
    persistent
  >
    <q-card style="width: 500px; max-width: 100%;" class="q-pa-md">
      <h3 class="font text-h5 q-mt-none">Create User</h3>
      <q-form @submit="onSubmit">
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
        <q-input
          class="q-mb-md"
          hide-bottom-space
          outlined
          type="password"
          autocomplete="new-password"
          v-model="userModel.password"
          label="Password"
          :rules="[
            val => !!val || 'Password field if required',
            val => val.length > 7 || 'Please use minimum 8 symbols',
          ]"
          hint="Temporary one-time password.
          User will be promoted to enter password after first success login."
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
        <div v-if="submitUserError" class="text-red text-center q-my-md">
          {{ submitUserError }}
        </div>
        <div class="row justify-between">
          <q-btn label="Cancel" @click="hide()" />
          <q-btn label="Save" color="primary" type="submit" />
        </div>
      </q-form>
    </q-card>
  </q-dialog>
</template>
<script>
import { useQuasar } from 'quasar';
import { defineComponent, ref } from 'vue';
import { roleOptions } from 'src/const/userRoles';
import { useMutation } from '@vue/apollo-composable';
import { createUser } from 'src/graphql/createUser';

export default defineComponent({
  name: 'CreateUserDialog',
  setup() {
    const $q = useQuasar();
    const isActive = ref(false);
    const dialog = ref(null);
    const userModel = ref({
      name: '',
      email: '',
      password: '',
      role: '',
    });

    const { mutate: submitUser, loading: isSubmittingUser, error: submitUserError } = useMutation(createUser);

    return {
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
        submitUser({
          name: userModel.value.name,
          email: userModel.value.email,
          password: userModel.value.password,
        });
        $q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Submitted',
        });
      },
      isSubmittingUser,
      submitUserError,
    };
  },
});
</script>
