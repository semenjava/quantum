<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Models\Manager;
use App\Models\Provider;
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

        User::where('role', 'superadmin')->delete();
        User::where('role', 'manager')->delete();
        User::where('role', 'facility')->delete();
        User::where('role', 'provider')->delete();
        User::where('role', 'company')->delete();
        User::where('role', 'employee')->delete();

        \DB::table('managers')->truncate();
        \DB::table('facilities')->truncate();
        \DB::table('providers')->truncate();
        \DB::table('users')->truncate();

        $user1 = new User();
        $user1->name = 'Admin';
        $user1->email = 'admin@admin.com';
        $user1->password = Hash::make('admin');
        $user1->role = 'superadmin';
        $user1->time_zone = 'America/New_York';
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
        $user2->time_zone = 'America/New_York';
        $user2->save();
        $user2->roles()->attach($roles->get('manager'));
        foreach ($roles->get('manager')->permissions as $permission) {
            $user2->permissions()->attach($permission);
        }

        $manager = new Manager();
        $manager->user_id = $user2->id;
        $manager->first_name = $user2->name;
        $manager->surname = $user2->name;
        $manager->last_name = $user2->name;
        $manager->save();

        $user3 = new User();
        $user3->name = 'Facility';
        $user3->email = 'facility@facility.com';
        $user3->password = Hash::make('facility');
        $user3->role = 'facility';
        $user3->time_zone = 'America/New_York';
        $user3->save();
        $user3->roles()->attach($roles->get('facility'));
        foreach ($roles->get('facility')->permissions as $permission) {
            $user3->permissions()->attach($permission);
        }

        $facility = new Facilities();
        $facility->user_id = $user3->id;
        $facility->name = $user3->name;
        $facility->save();

        $user4 = new User();
        $user4->name = 'Provider';
        $user4->email = 'provider@provider.com';
        $user4->password = Hash::make('provider');
        $user4->role = 'provider';
        $user4->time_zone = 'America/New_York';
        $user4->save();
        $user4->roles()->attach($roles->get('provider'));
        foreach ($roles->get('provider')->permissions as $permission) {
            $user4->permissions()->attach($permission);
        }

        $provider = new Provider();
        $provider->user_id = $user4->id;
        $provider->first_name = $user4->name;
        $provider->surname = $user4->name;
        $provider->last_name = $user4->name;
        $provider->save();

        $user5 = new User();
        $user5->name = 'Company';
        $user5->email = 'company@company.com';
        $user5->password = Hash::make('company');
        $user5->role = 'company';
        $user5->time_zone = 'America/New_York';
        $user5->save();
        $user5->roles()->attach($roles->get('company'));
        foreach ($roles->get('company')->permissions as $permission) {
            $user5->permissions()->attach($permission);
        }

        $company = new Companies();
        $company->user_id = $user5->id;
        $company->name = $user5->name;
        $company->save();

        $user6 = new User();
        $user6->name = 'Employee';
        $user6->email = 'employee@employee.com';
        $user6->password = Hash::make('employee');
        $user6->role = 'employee';
        $user6->time_zone = 'America/New_York';
        $user6->save();
        $user6->roles()->attach($roles->get('employee'));
        foreach ($roles->get('employee')->permissions as $permission) {
            $user6->permissions()->attach($permission);
        }

        $employee = new Employees();
        $employee->user_id = $user6->id;
        $employee->company_id = $company->id;
        $employee->first_name = $user6->name;
        $employee->surname = $user6->name;
        $employee->last_name = $user6->name;
        $employee->save();
    }
}
