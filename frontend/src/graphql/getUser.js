import gql from 'graphql-tag';

export const getUserById = gql`
  query getUserById ($id: ID!) {
    user(id: $id) {
      id
      name
      email
      timezone: time_zone
      created_at
      updated_at
      role
    }
  }
`;
