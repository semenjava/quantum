<?php

namespace Tests;

use App\Models\User;
use App\Traits\RolesGet;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\ClearsSchemaCache;
use Faker\Generator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests;
    use ClearsSchemaCache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bootClearsSchemaCache();
    }

    protected function fakerUser($role, $password)
    {
        return User::factory()->make([
            'password' => \Hash::make($password),
            'role' => $role
        ]);
    }

    protected function getHeaders($token)
    {
        return [
            "Authorization" => "Bearer $token"
        ];
    }

    /**
     * Create And Login as Super Admin.
     *
     * @return bool|mixed
     */
    protected function loginAsSuperAdmin()
    {
        $password = 'super_admin'.round(10,99).'!';
        $user = $this->fakerUser(User::SUPERADMIN, $password);
        $email = $user->email;

        $token = $this->loginSuperAdmin();
        $headers = $this->getHeaders($token);

        $super_admin = $this->createAsSuperAdmin($user, $password, $headers);

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($email: String!, $password: String!) {
              login(email: $email, password: $password) {
                user {
                  id,
                  name,
                  email,
                  role,
                },
                token
              }
            }
        ', [
            'email' => $email,
            'password' => $password
            ])->assertJson([
                'data' => [
                    'login' => [
                        'user' => [
                            'id' => $super_admin['id'],
                            'name' => $super_admin['name'],
                            'email' => $super_admin['email'],
                            'role' => $super_admin['role'],
                        ],
                    ],
                ],
            ]);

        return $response->original['data']['login']['token'];
    }

    protected function createAsSuperAdmin($user, $password, $headers)
    {

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
            'role' => User::SUPERADMIN,
            'time_zone' => 'America/New_York'
        ], [], $headers);

        return $response->original['data']['createUser'];
    }

    public function loginSuperAdmin()
    {
        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($email: String!, $password: String!) {
            login(email: $email, password: $password) {
                    user {
                      id,
                      name,
                      email,
                      role,
                    },
                    token
                }
            }
        ', [
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);

        return $response->original['data']['login']['token'];
    }

    public function loginUser($email, $password)
    {
        $response = $this->graphQL(/** @lang GraphQL */ '
        mutation ($email: String!, $password: String!) {
            login(email: $email, password: $password) {
                    user {
                      id,
                      name,
                      email,
                      role,
                    },
                    token
                }
            }
        ', [
            'email' => $email,
            'password' => $password
        ]);

        return $response->original['data']['login']['token'];
    }

    public function createUser($role, $model, $company_id = 1)
    {
        $roles = RolesGet::getRoles();
        $user = User::factory()->create([
            'password' => \Hash::make($role),
            'role' => $role,
            'time_zone' => 'America/New_York'
        ]);
        $user->roles()->attach($roles->get($role));
        foreach ($roles->get($role)->permissions as $permission) {
            $user->permissions()->attach($permission);
        }

        $model->user_id = $user->id;
        if($role == User::FACILITY) {
            $model->name = $user->name;
        }
        if($role == User::MANAGER) {
            $model->first_name = $user->name;
            $model->surname = $user->name;
            $model->last_name = $user->name;
        }
        if($role == User::PROVIDER) {
            $model->first_name = $user->name;
            $model->surname = $user->name;
            $model->last_name = $user->name;
        }
        if($role == User::COMPANY) {
            $model->name = $user->name;
        }
        if($role == User::EMPLOYEE) {
            $model->company_id = $company_id;
            $model->first_name = $user->name;
            $model->surname = $user->name;
            $model->last_name = $user->name;
        }
        $model->save();

        return $model;
    }
}
