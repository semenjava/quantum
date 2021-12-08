<template>
  <q-page class="flex flex-center bg-blue-grey-5">
    <q-card bordered class="q-pa-lg shadow-5">
      <q-card-section>
        <q-form class="q-gutter-md">
          <q-input v-model="email" type="email" label="Email" />
          <q-input v-model="password" type="password" label="Password" />
        </q-form>
      </q-card-section>
      <q-card-actions class="q-px-md">
        <q-btn color="light-blue-7" size="lg" class="full-width" label="Login"
               @click.prevent="login" />
      </q-card-actions>
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
    const $q = useQuasar();
    const $store = inject('store');
    const $router = useRouter();

    return {
      email,
      password,
      async login() {
        $q.loading.show();
        await $store.dispatch('app/login', {
          email: email.value,
          password: password.value,
        });
        if ($store.getters['app/isLoggedIn']) {
          $router.push('/');
        }
        $q.loading.hide();
      },
    };
  },
});
</script>
