import gql from 'graphql-tag';

export const getUsers = gql`
  query getUsers($first: Int!, $page: Int) {
    users(first: $first, page: $page) {
      data {
        id
        name
        email
        created_at
        updated_at
        role
      }
      paginatorInfo {
        currentPage
        count
        firstItem
        lastItem
        perPage
      }
    }
  }
`;
