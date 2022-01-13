<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $adminToken = $this->loginAsSuperAdmin();
        $facilityToken = $this->loginFacility($adminToken);
        $providerToken = $this->loginProvider($adminToken);
        $company  = $this->loginCompany($adminToken);
        $employeeToken = $this->loginEmployee($adminToken, $company['id']);
    }

    private function loginFacility($token)
    {
        $headers = $this->getHeaders($token);
        $password = 'facility'.round(10,99).'!';
        $user = $this->fakerUser(User::FACILITY, $password);

        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($name: String!, $email: String!, $password: String!, $c_password: String!) {
            createUserFacility(name: $name, email: $email, password: $password, c_password: $c_password) {
                  id,
                  name,
                  user {
                    id,
                    name,
                    email,
                    role
                  },
                  addresses {
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
                  },
                  specialties {
                    id,
                    name
                  }
                }
            }
        ', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'c_password' => $password,
            'role' => User::FACILITY,
            'time_zone' => 'America/New_York'
        ], [], $headers)->assertJson([
            'data' => [
                'createUserFacility' => [
                    'name' => $user->name,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ],
            ],
        ]);

        $data = $response->original['data']['createUserFacility']['user'];
        $token = $this->loginUser($data['email'], $password);

        return $token;
    }

    private function loginProvider($token)
    {
        $headers = $this->getHeaders($token);
        $password = 'provider'.round(10,99).'!';
        $user = $this->fakerUser(User::PROVIDER, $password);

        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($first_name: String!, $surname: String!, $last_name: String, $email: String!, $password: String!, $c_password: String!) {
            createUserProvider(form: {first_name: $first_name, surname: $surname, last_name: $last_name, email: $email, password: $password, c_password: $c_password}) {
                  id,
                  first_name,
                  surname,
                  last_name,
                  diagnostic_specialty,
                  language,
                  user {
                    id,
                    name,
                    email,
                    role
                  },
                  addresses {
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
                  },
                  specialties {
                    id,
                    name
                  }
                }
            }
        ', [
            'first_name' => $user->name,
            'surname' => $user->name,
            'last_name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'c_password' => $password,
            'role' => User::PROVIDER,
            'time_zone' => 'America/New_York'
        ], [], $headers)->assertJson([
            'data' => [
                'createUserProvider' => [
                    'first_name' => $user->name,
                    'surname' => $user->name,
                    'last_name' => $user->name,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ],
            ],
        ]);

        $data = $response->original['data']['createUserProvider']['user'];
        $token = $this->loginUser($data['email'], $password);

        return $token;
    }

    private function loginCompany($token)
    {
        $headers = $this->getHeaders($token);
        $password = 'company'.round(10,99).'!';
        $user = $this->fakerUser(User::COMPANY, $password);

        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($name: String!, $email: String!, $password: String!, $c_password: String!) {
            createUserCompany(name: $name, email: $email, password: $password, c_password: $c_password) {
                  id,
                  name,
                  phone,
                  fax,
                  count_employee,
                  user {
                    id,
                    name,
                    email,
                    role
                  },
                  addresses {
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
            }
        ', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'c_password' => $password,
            'role' => User::COMPANY,
            'time_zone' => 'America/New_York'
        ], [], $headers)->assertJson([
            'data' => [
                'createUserCompany' => [
                    'name' => $user->name,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                ],
            ],
        ]);

        $data = $response->original['data']['createUserCompany'];
        $token = $this->loginUser($user->email, $password);
        $data['token'] = $token;

        return $data;
    }

    private function loginEmployee($token, $company_id)
    {
        $headers = $this->getHeaders($token);
        $password = 'employee'.round(10,99).'!';
        $user = $this->fakerUser(User::EMPLOYEE, $password);

        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($first_name: String!, $surname: String!, $last_name: String, $company_id: Int!, $email: String!, $password: String!, $c_password: String!) {
            createUserEmployee(first_name: $first_name, surname: $surname, last_name: $last_name, company_id: $company_id,  email: $email, password: $password, c_password: $c_password) {
                  id,
                  first_name,
                  surname,
                  last_name,
                  user {
                    id,
                    name,
                    email,
                    role
                  },
                  addresses {
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
                  },
                  company {
                    id,
                    name,
                  }
                }
            }
        ', [
            'first_name' => $user->name,
            'surname' => $user->name,
            'last_name' => $user->name,
            'company_id' => (int)$company_id,
            'email' => $user->email,
            'password' => $password,
            'c_password' => $password,
            'role' => User::EMPLOYEE,
            'time_zone' => 'America/New_York'
        ], [], $headers)->assertJson([
            'data' => [
                'createUserEmployee' => [
                    'first_name' => $user->name,
                    'surname' => $user->name,
                    'last_name' => $user->name,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'company' => [
                        'id' => $company_id
                    ]
                ],
            ],
        ]);

        $data = $response->original['data']['createUserEmployee']['user'];
        $token = $this->loginUser($data['email'], $password);

        return $token;
    }
}
