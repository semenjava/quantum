import gql from 'graphql-tag';

export const login = gql`
  mutation login($email: String!, $password: String!) {
    login(email: $email, password: $password) {
      user {
        id,
        name,
        email,
        lang,
        role,
        timezone: time_zone
      },
      token
    }
  }
`;
