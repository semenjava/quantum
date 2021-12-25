import gql from 'graphql-tag';

export const getUsers = gql`
  query getUsers($first: Int!, $page: Int!, $search: String, $sort: [OrderByClause!], $archived: Boolean) {
    users(first: $first, page: $page, search: $search, sort: $sort, archived: $archived) {
      data {
        id
        name
        email
        time_zone
        created_at
        updated_at
        role
      }
      paginatorInfo {
        total
        currentPage
        firstItem
        lastItem
        perPage
      }
    }
  }
`;
