import gql from 'graphql-tag';

export const editUser = gql`
  mutation editUser ($lang: String, $timezone: String) {
    edit(
      lang: $lang
      time_zone: $timezone
    ) {
      id
    }
  }
`;
