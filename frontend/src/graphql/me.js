import gql from 'graphql-tag';

export const me = gql`
  {
    me {
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
