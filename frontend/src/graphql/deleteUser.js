import gql from 'graphql-tag';

export const deleteUser = gql`
  mutation deleteUser ($id: ID) {
    deleteUser(
      id: $id
    ) {
      id
    }
  }
`;
