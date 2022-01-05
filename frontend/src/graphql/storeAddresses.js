import gql from 'graphql-tag';

export const storeProviderAddresses = gql`
  mutation storeAddress (
    $addresses: [StoreAddress!]!
  ) {
    storeAddress(
      addresses: $addresses
    ) {
      address_line_1
      address_line_2
      city
      country
      postal
      state
      office_address
      billing_address
      postal_address
    }
  }
`;
