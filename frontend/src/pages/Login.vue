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
import { gql } from 'apollo-boost';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    async login() {
      const result = await this.$apollo.mutate({
        mutation: gql`mutation {
          login(email: "$email", password: "$password") {
            user {
              id,
                name,
                email,
                lang,
                time_zone
            },
            token
          }
        }`,
        variables: {
          email: this.email,
          password: this.password,
        },
      });

      console.log(result);
    },
  },
};
</script>
