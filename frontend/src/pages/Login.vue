<template>
  <q-page class="flex flex-center bg-blue-grey-5">
    <q-card bordered class="q-pa-lg shadow-5">
      <q-card-section>
        <q-form @submit="login">
          <q-input
            class="q-mb-sm"
            v-model="email"
            type="email"
            label="Email"
            :rules="[val => !!val || 'Field is required']"
          />
          <q-input
            class="q-mb-sm"
            v-model="password"
            type="password"
            label="Password"
            :rules="[val => !!val || 'Field is required']"
          />
          <q-btn
            type="submit"
            color="light-blue-7"
            size="lg"
            class="q-mt-sm full-width"
            label="Login"
          />
          <div v-if="error" class="q-mt-md text-red text-center">{{ error }}</div>
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>
<script>
import { useQuasar } from 'quasar';
import { ref, defineComponent, inject } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  name: 'Login',
  setup() {
    const email = ref('');
    const password = ref('');
    const error = ref('');
    const $q = useQuasar();
    const $store = inject('store');
    const $router = useRouter();

    return {
      email,
      password,
      error,
      async login() {
        $q.loading.show();
        try {
          await $store.dispatch('app/login', {
            email: email.value,
            password: password.value,
          });
        } catch (e) {
          error.value = e.message;
        }
        if ($store.getters['app/isLoggedIn']) {
          $router.push('/');
        }
        $q.loading.hide();
      },
    };
  },
});
</script>
