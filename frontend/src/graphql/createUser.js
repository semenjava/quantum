import gql from 'graphql-tag';

export const createUser = gql`
  mutation createUser ($name: String!, $email: String!, $password: String!) {
    createUser(name: $name, email: $email, password: $password, c_password: $password) {
      success
      message
    }
  }
`;
