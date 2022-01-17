<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $token = $this->loginSuperAdmin();

        $provider = User::where('role', User::PROVIDER)->first();
        $facility = User::where('role', User::FACILITY)->first();
        $company  = User::where('role', User::COMPANY)->first();
        $employee = User::find(6);

        $address_line = $this->createAddress($token, $provider, $facility, $company, $employee);
        $this->getUserAddress($token, $provider, $facility, $company, $employee, $address_line);
    }

    private function createAddress($token, $provider, $facility, $company, $employee)
    {
        $address_line = [];

        $headers = $this->getHeaders($token);
        /**
         * Create Address Provider
         */

        $address1 = Address::factory()->make([
            'postal_address' => true,
            'office_address' => false,
            'billing_address' => true
        ]);
        $address2 = Address::factory()->make([
            'postal_address' => false,
            'office_address' => true,
            'billing_address' => false
        ]);

        $address_line[] = $address1->address_line_1;
        $address_line[] = $address2->address_line_1;

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($provider_id: Int!,
                $address_line_11: String!, $address_line_21: String, $country1: String, $state1: String, $city1: String, $postal1: String, $postal_address1: Boolean, $office_address1: Boolean, $billing_address1: Boolean,
                $address_line_12: String!, $address_line_22: String, $country2: String, $state2: String, $city2: String, $postal2: String, $postal_address2: Boolean, $office_address2: Boolean, $billing_address2: Boolean) {
              storeAddress(
                provider_id: $provider_id,
                addresses: [{
                  address_line_1: $address_line_11,
                  address_line_2: $address_line_21,
                  country: $country1,
                  state: $state1,
                  city: $city1,
                  postal: $postal1,
                  postal_address: $postal_address1,
                  office_address: $office_address1,
                  billing_address: $billing_address1
                },
                {
                  address_line_1: $address_line_12,
                  address_line_2: $address_line_22,
                  country: $country2,
                  state: $state2,
                  city: $city2,
                  postal: $postal2,
                  postal_address: $postal_address2,
                  office_address: $office_address2,
                  billing_address: $billing_address2
                }]
                ){
                  id,
                  address_line_1,
                  address_line_2,
                  country,
                  state,
                  city,
                  postal,
                  postal_address,
                  office_address,
                  billing_address
              }
            }
        ',[
           'provider_id' =>  $provider->id,

            'address_line_11' => (string)$address1->address_line_1,
            'address_line_21' => (string)$address1->address_line_2,
            'country1' => $address1->country,
            'state1' =>  $address1->state,
            'city1' => $address1->city,
            'postal1' => $address1->postal,
            'postal_address1' => $address1->postal_address,
            'office_address1' => $address1->office_address,
            'billing_address1' => $address1->billing_address,

            'address_line_12' => (string)$address2->address_line_1,
            'address_line_22' => (string)$address2-> address_line_2,
            'country2' => $address2->country,
            'state2' => $address2->state,
            'city2' => $address2->city,
            'postal2' => $address2->postal,
            'postal_address2' => $address2->postal_address,
            'office_address2' => $address2->office_address,
            'billing_address2' => $address2->billing_address
        ], [], $headers)
            ->assertJson([
            'data' => [
                'storeAddress' => [
                        [
                            'address_line_1' => $address1->address_line_1,
                            'address_line_2' => $address1->address_line_2,
                            'country' => $address1->country,
                            'state' =>  $address1->state,
                            'city' => $address1->city,
                            'postal' => $address1->postal,
                            'postal_address' => $address1->postal_address,
                            'office_address' => $address1->office_address,
                            'billing_address' => $address1->billing_address,
                        ],
                        [
                            'address_line_1' => $address2->address_line_1,
                            'address_line_2' => $address2->address_line_2,
                            'country' => $address2->country,
                            'state' =>  $address2->state,
                            'city' => $address2->city,
                            'postal' => $address2->postal,
                            'postal_address' => $address2->postal_address,
                            'office_address' => $address2->office_address,
                            'billing_address' => $address2->billing_address,
                        ],
                ],
            ],
        ]);

        /**
         * Create Address facility
         */
        $address3 = Address::factory()->make([
            'postal_address' => true,
            'office_address' => false,
            'billing_address' => true
        ]);
        $address4 = Address::factory()->make([
            'postal_address' => false,
            'office_address' => true,
            'billing_address' => false
        ]);

        $address_line[] = $address3->address_line_1;
        $address_line[] = $address4->address_line_1;

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($facility_id: Int!,
                $address_line_11: String!, $address_line_21: String, $country1: String, $state1: String, $city1: String, $postal1: String, $postal_address1: Boolean, $office_address1: Boolean, $billing_address1: Boolean,
                $address_line_12: String!, $address_line_22: String, $country2: String, $state2: String, $city2: String, $postal2: String, $postal_address2: Boolean, $office_address2: Boolean, $billing_address2: Boolean) {
              storeAddress(
                facility_id: $facility_id,
                addresses: [{
                  address_line_1: $address_line_11,
                  address_line_2: $address_line_21,
                  country: $country1,
                  state: $state1,
                  city: $city1,
                  postal: $postal1,
                  postal_address: $postal_address1,
                  office_address: $office_address1,
                  billing_address: $billing_address1
                },
                {
                  address_line_1: $address_line_12,
                  address_line_2: $address_line_22,
                  country: $country2,
                  state: $state2,
                  city: $city2,
                  postal: $postal2,
                  postal_address: $postal_address2,
                  office_address: $office_address2,
                  billing_address: $billing_address2
                }]
                ){
                  id,
                  address_line_1,
                  address_line_2,
                  country,
                  state,
                  city,
                  postal,
                  postal_address,
                  office_address,
                  billing_address
              }
            }
        ',[
            'facility_id' =>  $facility->id,

            'address_line_11' => (string)$address3->address_line_1,
            'address_line_21' => (string)$address3->address_line_2,
            'country1' => $address3->country,
            'state1' =>  $address3->state,
            'city1' => $address3->city,
            'postal1' => $address3->postal,
            'postal_address1' => $address3->postal_address,
            'office_address1' => $address3->office_address,
            'billing_address1' => $address3->billing_address,

            'address_line_12' => (string)$address4->address_line_1,
            'address_line_22' => (string)$address4-> address_line_2,
            'country2' => $address4->country,
            'state2' => $address4->state,
            'city2' => $address4->city,
            'postal2' => $address4->postal,
            'postal_address2' => $address4->postal_address,
            'office_address2' => $address4->office_address,
            'billing_address2' => $address4->billing_address
        ], [], $headers)->assertJson([
            'data' => [
                'storeAddress' => [
                        [
                            'address_line_1' => $address3->address_line_1,
                            'address_line_2' => $address3->address_line_2,
                            'country' => $address3->country,
                            'state' =>  $address3->state,
                            'city' => $address3->city,
                            'postal' => $address3->postal,
                            'postal_address' => $address3->postal_address,
                            'office_address' => $address3->office_address,
                            'billing_address' => $address3->billing_address,
                        ],
                        [
                            'address_line_1' => $address4->address_line_1,
                            'address_line_2' => $address4->address_line_2,
                            'country' => $address4->country,
                            'state' =>  $address4->state,
                            'city' => $address4->city,
                            'postal' => $address4->postal,
                            'postal_address' => $address4->postal_address,
                            'office_address' => $address4->office_address,
                            'billing_address' => $address4->billing_address,
                        ],
                ],
            ],
        ]);

        /**
         * Create Address company
         */
        $address5 = Address::factory()->make([
            'postal_address' => true,
            'office_address' => false,
            'billing_address' => true
        ]);
        $address6 = Address::factory()->make([
            'postal_address' => false,
            'office_address' => true,
            'billing_address' => false
        ]);

        $address_line[] = $address5->address_line_1;
        $address_line[] = $address6->address_line_1;

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($company_id: Int!,
                $address_line_11: String!, $address_line_21: String, $country1: String, $state1: String, $city1: String, $postal1: String, $postal_address1: Boolean, $office_address1: Boolean, $billing_address1: Boolean,
                $address_line_12: String!, $address_line_22: String, $country2: String, $state2: String, $city2: String, $postal2: String, $postal_address2: Boolean, $office_address2: Boolean, $billing_address2: Boolean) {
              storeAddress(
                company_id: $company_id,
                addresses: [{
                  address_line_1: $address_line_11,
                  address_line_2: $address_line_21,
                  country: $country1,
                  state: $state1,
                  city: $city1,
                  postal: $postal1,
                  postal_address: $postal_address1,
                  office_address: $office_address1,
                  billing_address: $billing_address1
                },
                {
                  address_line_1: $address_line_12,
                  address_line_2: $address_line_22,
                  country: $country2,
                  state: $state2,
                  city: $city2,
                  postal: $postal2,
                  postal_address: $postal_address2,
                  office_address: $office_address2,
                  billing_address: $billing_address2
                }]
                ){
                  id,
                  address_line_1,
                  address_line_2,
                  country,
                  state,
                  city,
                  postal,
                  postal_address,
                  office_address,
                  billing_address
              }
            }
        ',[
            'company_id' =>  $company->id,

            'address_line_11' => (string)$address5->address_line_1,
            'address_line_21' => (string)$address5->address_line_2,
            'country1' => $address5->country,
            'state1' =>  $address5->state,
            'city1' => $address5->city,
            'postal1' => $address5->postal,
            'postal_address1' => $address5->postal_address,
            'office_address1' => $address5->office_address,
            'billing_address1' => $address5->billing_address,

            'address_line_12' => (string)$address6->address_line_1,
            'address_line_22' => (string)$address6-> address_line_2,
            'country2' => $address6->country,
            'state2' => $address6->state,
            'city2' => $address6->city,
            'postal2' => $address6->postal,
            'postal_address2' => $address6->postal_address,
            'office_address2' => $address6->office_address,
            'billing_address2' => $address6->billing_address
        ], [], $headers)->assertJson([
            'data' => [
                'storeAddress' => [
                        [
                            'address_line_1' => $address5->address_line_1,
                            'address_line_2' => $address5->address_line_2,
                            'country' => $address5->country,
                            'state' =>  $address5->state,
                            'city' => $address5->city,
                            'postal' => $address5->postal,
                            'postal_address' => $address5->postal_address,
                            'office_address' => $address5->office_address,
                            'billing_address' => $address5->billing_address,
                        ],
                        [
                            'address_line_1' => $address6->address_line_1,
                            'address_line_2' => $address6->address_line_2,
                            'country' => $address6->country,
                            'state' =>  $address6->state,
                            'city' => $address6->city,
                            'postal' => $address6->postal,
                            'postal_address' => $address6->postal_address,
                            'office_address' => $address6->office_address,
                            'billing_address' => $address6->billing_address,
                        ],
                ],
            ],
        ]);

        /**
         * Create Address employee
         */
        $address7 = Address::factory()->make([
            'postal_address' => true,
            'office_address' => false,
            'billing_address' => true
        ]);
        $address8 = Address::factory()->make([
            'postal_address' => false,
            'office_address' => true,
            'billing_address' => false
        ]);

        $address_line[] = $address7->address_line_1;
        $address_line[] = $address8->address_line_1;

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($employee_id: Int!,
                $address_line_11: String!, $address_line_21: String, $country1: String, $state1: String, $city1: String, $postal1: String, $postal_address1: Boolean, $office_address1: Boolean, $billing_address1: Boolean,
                $address_line_12: String!, $address_line_22: String, $country2: String, $state2: String, $city2: String, $postal2: String, $postal_address2: Boolean, $office_address2: Boolean, $billing_address2: Boolean) {
              storeAddress(
                employee_id: $employee_id,
                addresses: [{
                  address_line_1: $address_line_11,
                  address_line_2: $address_line_21,
                  country: $country1,
                  state: $state1,
                  city: $city1,
                  postal: $postal1,
                  postal_address: $postal_address1,
                  office_address: $office_address1,
                  billing_address: $billing_address1
                },
                {
                  address_line_1: $address_line_12,
                  address_line_2: $address_line_22,
                  country: $country2,
                  state: $state2,
                  city: $city2,
                  postal: $postal2,
                  postal_address: $postal_address2,
                  office_address: $office_address2,
                  billing_address: $billing_address2
                }]
                ){
                  id,
                  address_line_1,
                  address_line_2,
                  country,
                  state,
                  city,
                  postal,
                  postal_address,
                  office_address,
                  billing_address
              }
            }
        ',[
            'employee_id' =>  $employee->id,

            'address_line_11' => (string)$address7->address_line_1,
            'address_line_21' => (string)$address7->address_line_2,
            'country1' => $address7->country,
            'state1' =>  $address7->state,
            'city1' => $address7->city,
            'postal1' => $address7->postal,
            'postal_address1' => $address7->postal_address,
            'office_address1' => $address7->office_address,
            'billing_address1' => $address7->billing_address,

            'address_line_12' => (string)$address8->address_line_1,
            'address_line_22' => (string)$address8-> address_line_2,
            'country2' => $address8->country,
            'state2' => $address8->state,
            'city2' => $address8->city,
            'postal2' => $address8->postal,
            'postal_address2' => $address8->postal_address,
            'office_address2' => $address8->office_address,
            'billing_address2' => $address8->billing_address
        ], [], $headers)
            ->assertJson([
            'data' => [
                'storeAddress' => [
                        [
                            'address_line_1' => $address7->address_line_1,
                            'address_line_2' => $address7->address_line_2,
                            'country' => $address7->country,
                            'state' =>  $address7->state,
                            'city' => $address7->city,
                            'postal' => $address7->postal,
                            'postal_address' => $address7->postal_address,
                            'office_address' => $address7->office_address,
                            'billing_address' => $address7->billing_address,
                        ],
                        [
                            'address_line_1' => $address8->address_line_1,
                            'address_line_2' => $address8->address_line_2,
                            'country' => $address8->country,
                            'state' =>  $address8->state,
                            'city' => $address8->city,
                            'postal' => $address8->postal,
                            'postal_address' => $address8->postal_address,
                            'office_address' => $address8->office_address,
                            'billing_address' => $address8->billing_address,
                        ],
                ],
            ],
        ]);

        return $address_line;
    }

    private function getUserAddress($token, $provider, $facility, $company, $employee, $address_line)
    {
        $headers = $this->getHeaders($token);

        $response = $this->graphQL(/** @lang GraphQL */ '
            {
              getAddresses(provider_id: '.(int)$provider->id.')
              {
                address_line_1,
                address_line_2,
                country,
                state,
                city,
                postal,
                postal_address,
                office_address,
                billing_address
              }
            }
        ',[], [], $headers);

        $lines_address = $response->json("data.getAddresses.*.address_line_1");

        $this->assertSame(
            [
                $address_line[0],
                $address_line[1]
            ],
            $lines_address
        );

        $response = $this->graphQL(/** @lang GraphQL */ '
            {
              getAddresses(facility_id: '.(int)$facility->id.')
              {
                address_line_1,
                address_line_2,
                country,
                state,
                city,
                postal,
                postal_address,
                office_address,
                billing_address
              }
            }
        ',[], [], $headers);

        $lines_address = $response->json("data.getAddresses.*.address_line_1");

        $this->assertSame(
            [
                $address_line[2],
                $address_line[3]
            ],
            $lines_address
        );

        $response = $this->graphQL(/** @lang GraphQL */ '
            {
              getAddresses(company_id: '.(int)$company->id.')
              {
                address_line_1,
                address_line_2,
                country,
                state,
                city,
                postal,
                postal_address,
                office_address,
                billing_address
              }
            }
        ',[], [], $headers);

        $lines_address = $response->json("data.getAddresses.*.address_line_1");

        $this->assertSame(
            [
                $address_line[4],
                $address_line[5]
            ],
            $lines_address
        );

        $response = $this->graphQL(/** @lang GraphQL */ '
            {
              getAddresses(employee_id: '.(int)$employee->id.')
              {
                address_line_1,
                address_line_2,
                country,
                state,
                city,
                postal,
                postal_address,
                office_address,
                billing_address
              }
            }
        ',[], [], $headers);

        $lines_address = $response->json("data.getAddresses.*.address_line_1");

        $this->assertSame(
            [
                $address_line[6],
                $address_line[7]
            ],
            $lines_address
        );
    }
}
