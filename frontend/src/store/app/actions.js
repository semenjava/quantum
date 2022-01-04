import { useMutation, provideApolloClient } from '@vue/apollo-composable';
import { login as loginMutation } from 'src/graphql/login';
import { logout as logoutMutation } from 'src/graphql/logout';
import { apolloClient } from 'boot/vue-apollo';
import { userDefaultState } from './state';

provideApolloClient(apolloClient);

export async function login({ commit }, { email, password }) {
  const { mutate: loginMutate, onDone, onError } = useMutation(loginMutation);

  onDone((result) => {
    const { token, user } = result.data.login;

    commit('updateUser', {
      id: user.id,
      name: user.name,
      email: user.email,
      lang: user.lang,
      timezone: user.timezone,
      role: user.role,
      token,
    });
  });

  onError((error) => {
    throw new Error(error);
  });

  await loginMutate({
    email,
    password,
  });
}

export async function logout({ commit }) {
  const { mutate: logoutMutate } = useMutation(logoutMutation);
  await logoutMutate();
  commit('updateUser', JSON.parse(JSON.stringify(userDefaultState)));
}
