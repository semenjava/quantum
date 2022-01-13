<?php

namespace Tests\Feature;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $token = $this->loginSuperAdmin();
        $this->getFacility($token);
        $this->getProvider($token);
        $id = $this->getCompany($token);
        $this->getEmployee($token, $id);
    }

    private function getFacility($token)
    {
        $facility = new Facilities();
        $facility = $this->createUser(User::FACILITY, $facility);

        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        {
            getUserFacility(search:"'.$facility->name.'", sort: [
                    {
                      column: "name"
                      order: DESC
                    }
              ], first: 10000, page:1, archived: false) {
                  data {
                        id,
                        name,
                    }
                    paginatorInfo {
                        total
                        currentPage
                        lastPage
                        perPage
                    }
                }
            }
        ', [], [], $headers);

        $names = $response->json("data.*.data.*.name");

        $this->assertSame(
            [
                $facility->name
            ],
            $names
        );
    }

    private function getProvider($token)
    {
        $provider = new Provider();
        $provider = $this->createUser(User::PROVIDER, $provider);

        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        {
            getUserProvider(search:"'.$provider->first_name.'", sort: [
                    {
                      column: "first_name"
                      order: DESC
                    }
              ], first: 10, page:1, archived: false) {
                  data {
                        id,
                        first_name,
                    }
                    paginatorInfo {
                        total
                        currentPage
                        lastPage
                        perPage
                    }
                }
            }
        ', [], [], $headers);

        $names = $response->json("data.*.data.*.first_name");

        $this->assertSame(
            [
                $provider->first_name
            ],
            $names
        );

    }

    private function getCompany($token)
    {
        $company = new Companies();
        $company = $this->createUser(User::COMPANY, $company);

        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        {
            getUserCompany(search:"'.$company->name.'", sort: [
                    {
                      column: "name"
                      order: DESC
                    }
              ], first: 10, page:1, archived: false) {
                  data {
                        id,
                        name,
                    }
                    paginatorInfo {
                        total
                        currentPage
                        lastPage
                        perPage
                    }
                }
            }
        ', [], [], $headers);

        $names = $response->json("data.*.data.*.name");
        $ids = $response->json("data.*.data.*.id");

        $this->assertSame(
            [
                $company->name
            ],
            $names
        );

        return end($ids);
    }

    private function getEmployee($token, $id)
    {
        $employee = new Employees();
        $employee = $this->createUser(User::EMPLOYEE, $employee, $id);

        $headers = $this->getHeaders($token);
        $response = $this->graphQL(/** @lang GraphQL */ '
        {
            getUserEmployee(search:"'.$employee->first_name.'", sort: [
                    {
                      column: "first_name"
                      order: DESC
                    }
              ], first: 10, page:1, archived: false) {
                  data {
                        id,
                        first_name,
                    }
                    paginatorInfo {
                        total
                        currentPage
                        lastPage
                        perPage
                    }
                }
            }
        ', [], [], $headers);

        $names = $response->json("data.*.data.*.first_name");

        $this->assertSame(
            [
                $employee->first_name
            ],
            $names
        );

    }
}
