import gql from 'graphql-tag';

export const editUser = gql`
  mutation editUser ($id: Int!, $name: String, $email: String, $role: String, $timezone: String) {
    editUser(
      user_id: $id
      name: $name
      email: $email
      role: $role,
      time_zone: $timezone
    ) {
      id
    }
  }
`;
