import gql from 'graphql-tag';

export const getUsers = gql`
  query getUsers($first: Int!, $page: Int, $search: String, $sort: [OrderByClause!]) {
    users(first: $first, page: $page, search: $search, sort: $sort) {
      data {
        id
        name
        email
        timezone: time_zone
        createdAt: created_at
        updatedAt: updated_at
        role
      }
      paginatorInfo {
        count
        currentPage
        firstItem
        lastItem
        perPage
      }
    }
  }
`;
