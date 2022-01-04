import gql from 'graphql-tag';

export const storeProviderAddress = gql`
  mutation storeAddress (
    $address_line_1: String!
    $address_line_2: String
    $city: String
    $country: String
    $postal: String
    $postal_address: Boolean
    $billing_address: Boolean
    $office_address: Boolean
    $provider_id: Int!
    $state: String
  ) {
    storeAddress(
      address_line_1: $address_line_1
      address_line_2: $address_line_2
      city: $city
      country: $country
      postal: $postal
      postal_address: $postal_address
      billing_address: $billing_address
      office_address: $office_address
      provider_id: $provider_id
      state: $state
    ) {
      address_line_1
      address_line_2
      city
      country
      postal
      state
      primary_address
      billing_address
      postal_address
    }
  }
`;
