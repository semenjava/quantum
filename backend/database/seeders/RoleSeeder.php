<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Roles();
        $admin->name = 'Super Admin';
        $admin->slug = 'superadmin';
        $admin->save();

        $manager = new Roles();
        $manager->name = 'Manager';
        $manager->slug = 'manager';
        $manager->save();

        $organization = new Roles();
        $organization->name = 'Facility admins';
        $organization->slug = 'facility';
        $organization->save();

        $provider = new Roles();
        $provider->name = 'Provider';
        $provider->slug = 'provider';
        $provider->save();

        $company = new Roles();
        $company->name = 'Company';
        $company->slug = 'company';
        $company->save();

        $employee = new Roles();
        $employee->name = 'Employee';
        $employee->slug = 'employee';
        $employee->save();
    }
}
