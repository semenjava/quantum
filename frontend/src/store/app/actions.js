import { useMutation, provideApolloClient } from '@vue/apollo-composable';
import { login as loginMutation } from 'src/graphql/login';
import { logout as logoutMutation } from 'src/graphql/logout';
import { me as meQuery } from 'src/graphql/me';
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

export async function checkUserToken({ commit }) {
  const res = await apolloClient.query({
    query: meQuery,
    fetchPolicy: 'no-cache',
  }).catch(() => {
    commit('updateUser', JSON.parse(JSON.stringify(userDefaultState)));
    return false;
  });

  return !!(res.data && res.data.me && res.data.me.id);
}

export async function logout({ commit }) {
  const { mutate: logoutMutate } = useMutation(logoutMutation);
  try {
    await logoutMutate();
  } catch (e) {
    // Ignore errors
    // console.log(e)
  }
  commit('updateUser', JSON.parse(JSON.stringify(userDefaultState)));
}
