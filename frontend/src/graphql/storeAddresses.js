import gql from 'graphql-tag';

export const storeProviderAddresses = gql`
  mutation storeAddress (
    $addresses: [StoreAddress!]!
    $provider_id: Int
    $facility_id: Int
    $company_id: Int
    $employee_id: Int
  ) {
    storeAddress(
      addresses: $addresses
      provider_id: $provider_id
      facility_id: $facility_id
      company_id: $company_id
      employee_id: $employee_id
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
