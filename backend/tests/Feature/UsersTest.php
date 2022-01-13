<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $token = $this->loginSuperAdmin();
        $user = $this->createUsers($token);
        $this->getUsers($token, $user);
        $this->editUser($token, $user);
        $this->deleteUser($token, $user['id']);
    }

    private function createUsers($token)
    {
        $password = 'super_admin'.round(10,99).'!';
        $user = $this->fakerUser(User::SUPERADMIN, $password);

        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($name: String!, $email: String!, $password: String!, $c_password: String!, $role: String!, $time_zone: String!) {
            createUser(name: $name, email: $email, password: $password, c_password: $c_password, role: $role, time_zone: $time_zone) {
                  id,
                  name,
                  email,
                  lang,
                  created_at,
                  updated_at,
                  role
                }
            }
        ', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'c_password' => $password,
            'role' => User::EMPLOYEE,
            'time_zone' => 'America/New_York'
        ], [], $headers);

        return $response->original['data']['createUser'];
    }

    private function getUsers($token, $user)
    {
        /*
         , filter: [
                {
                  column: "id"
                  value: "'.$user['id'].'"
                }
              ]
         */
        $headers = $this->getHeaders($token);

        $response = $this->graphQL(/** @lang GraphQL */ '
            {
              users(search:"'.$user['name'].'", sort: [
                    {
                      column: "name"
                      order: DESC
                    }
              ], first: 2, page:1, archived: false)
              {
                data {
                    id,
                    name,
                    email,
                    lang,
                    role,
                    time_zone
                }
                paginatorInfo {
                    total
                    currentPage
                    lastPage
                    perPage
                }
              }
            }
        ',[], [], $headers)->assertJson([
            'data' => [
                'users' => [
                    'data' => [
                        [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        ]
                    ]
                ],
            ],
        ]);
    }

    private function editUser($token, $user)
    {
        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($user_id: Int!, $name: String, $email: String, $role: String) {
            editUser(user_id: $user_id, name: $name, email: $email, role: $role) {
                  id,
                  name,
                  email,
                  role,
                }
            }
        ', [
            'user_id' => (int)$user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ], [], $headers)->assertJson([
            'data' => [
                'editUser' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ],
            ],
        ]);
    }

    private function deleteUser($token, $user_id)
    {
        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($id: ID!) {
            deleteUser(id: $id) {
                  id,
                  name,
                  email,
                  role,
                }
            }
        ', [
            'id' => (int)$user_id,
        ], [], $headers)->assertJson([
            'data' => [
                'deleteUser' => [
                    'id' => $user_id,
                ],
            ],
        ]);
    }
}
