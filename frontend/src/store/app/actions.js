import gql from 'graphql-tag';
import { apolloClient } from 'boot/vue-apollo';
import { userDefaultState } from './state';

export async function login({ commit }, { email, password }) {
  const result = await apolloClient.mutate({
    mutation: gql`mutation {
      login(email: "${email}", password: "${password}") {
        user {
          id,
          name,
          email,
          lang,
          timezone: time_zone
        },
        token
      }
    }`,
  });
  const { token, user } = result.data.login;

  commit('updateUser', {
    id: user.id,
    name: user.name,
    email: user.email,
    lang: user.lang,
    timezone: user.timezone,
    // TODO: temp
    isAdmin: true,
    token,
  });
}

export async function logout({ commit }) {
  await apolloClient.mutate({
    mutation: gql`mutation {
      logout {
        message
      }
    }`,
  });
  commit('updateUser', JSON.parse(JSON.stringify(userDefaultState)));
}
