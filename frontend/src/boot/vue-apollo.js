import { createApolloProvider } from '@vue/apollo-option';
import {
  ApolloClient, ApolloLink, createHttpLink, InMemoryCache,
} from '@apollo/client/core';

// HTTP connection to the API
const httpLink = createHttpLink({
  // You should use an absolute URL here
  uri: process.env.GRAPHQL_URI || 'http://localhost:8084/graphql',
});

// Cache implementation
const cache = new InMemoryCache();

// Token middleware
const authMiddleware = new ApolloLink((operation, forward) => {
  // add the authorization to the headers
  let token = null;
  const vuexAppState = JSON.parse(localStorage.getItem('vuex'));
  if (vuexAppState) {
    token = vuexAppState.app.user.token;
  }
  operation.setContext({
    headers: {
      Authorization: token ? `Bearer ${token}` : null,
    },
  });

  return forward(operation);
});

// Create the apollo client
const apolloClient = new ApolloClient({
  link: authMiddleware.concat(httpLink),
  cache,
});

const apolloProvider = createApolloProvider({
  defaultClient: apolloClient,
});

export default ({ app }) => {
  app.use(apolloProvider);
};

export { apolloClient };
