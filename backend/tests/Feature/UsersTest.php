<?php

namespace Tests\Feature;

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
    }

    private function createUsers($token)
    {
        $headers = $this->getHeaders($token);
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
    }

    private function getUsers($token)
    {

    }
}
