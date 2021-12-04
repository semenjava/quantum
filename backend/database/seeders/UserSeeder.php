<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Traits\RolesGet;

class UserSeeder extends Seeder
{
    use RolesGet;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = RolesGet::getRoles();

        $user1 = new User();
        $user1->name = 'Admin';
        $user1->email = 'admin@admin.com';
        $user1->password = Hash::make('admin');
        $user1->role = 'superadmin';
        $user1->save();
        $user1->roles()->attach($roles->get('superadmin'));
        foreach ($roles->get('superadmin')->permissions as $permission) {
            $user1->permissions()->attach($permission);
        }

        $user2 = new User();
        $user2->name = 'Manager';
        $user2->email = 'manager@manager.com';
        $user2->password = Hash::make('manager');
        $user2->role = 'manager';
        $user2->save();
        $user2->roles()->attach($roles->get('manager'));
        foreach ($roles->get('manager')->permissions as $permission) {
            $user2->permissions()->attach($permission);
        }

        $user3 = new User();
        $user3->name = 'Organization';
        $user3->email = 'organization@organization.com';
        $user3->password = Hash::make('organization');
        $user3->role = 'organization';
        $user3->save();
        $user3->roles()->attach($roles->get('organization'));
        foreach ($roles->get('organization')->permissions as $permission) {
            $user3->permissions()->attach($permission);
        }

        $user4 = new User();
        $user4->name = 'Provider';
        $user4->email = 'provider@provider.com';
        $user4->password = Hash::make('provider');
        $user4->role = 'provider';
        $user4->save();
        $user4->roles()->attach($roles->get('provider'));
        foreach ($roles->get('provider')->permissions as $permission) {
            $user4->permissions()->attach($permission);
        }

        $user5 = new User();
        $user5->name = 'Company';
        $user5->email = 'company@company.com';
        $user5->password = Hash::make('company');
        $user5->role = 'company';
        $user5->save();
        $user5->roles()->attach($roles->get('company'));
        foreach ($roles->get('company')->permissions as $permission) {
            $user5->permissions()->attach($permission);
        }

        $user6 = new User();
        $user6->name = 'Employee';
        $user6->email = 'employee@employee.com';
        $user6->password = Hash::make('employee');
        $user6->role = 'employee';
        $user6->save();
        $user6->roles()->attach($roles->get('employee'));
        foreach ($roles->get('employee')->permissions as $permission) {
            $user6->permissions()->attach($permission);
        }
    }
}
