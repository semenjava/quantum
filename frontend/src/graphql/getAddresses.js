import gql from 'graphql-tag';

export const getAddresses = gql`
  query getAddresses (
    $provider_id: Int,
    $facility_id: Int,
    $company_id: Int,
    $employee_id: Int
  ) {
    getAddresses(
      provider_id: $provider_id,
      facility_id: $facility_id,
      company_id: $company_id,
      employee_id: $employee_id
    ) {
      id
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
