<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use App\Models\Permissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\Partials\{PermissionGet, RolesGet};

class UserSeeder extends Seeder
{
    use PermissionGet, RolesGet;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = RolesGet::getRoles();
        $permissions = PermissionGet::getPermissions();

        $user1 = new User();
        $user1->name = 'Admin';
        $user1->email = 'admin@admin.com';
        $user1->password = Hash::make('admin');
        $user1->role = 'superadmin';
        $user1->save();
        $user1->roles()->attach($roles->superadmin);
        foreach ($permissions as $permission) {
            $user1->permissions()->attach($permission);
        }

        $user2 = new User();
        $user2->name = 'Manager';
        $user2->email = 'manager@manager.com';
        $user2->password = Hash::make('manager');
        $user2->role = 'manager';
        $user2->save();
        $user2->roles()->attach($roles->manager);
        $user2->permissions()->attach($permissions->create);
        $user2->permissions()->attach($permissions->store);
        $user2->permissions()->attach($permissions->read);
        $user2->permissions()->attach($permissions->view);
        $user2->permissions()->attach($permissions->edit);
        $user2->permissions()->attach($permissions->update);
        $user2->permissions()->attach($permissions->{'read-own-manager'});
        $user2->permissions()->attach($permissions->{'view-own-manager'});
        $user2->permissions()->attach($permissions->{'edit-own-manager'});
        $user2->permissions()->attach($permissions->{'update-own-manager'});
        $user2->permissions()->attach($permissions->{'create-organization'});
        $user2->permissions()->attach($permissions->{'store-organization'});
        $user2->permissions()->attach($permissions->{'read-organization'});
        $user2->permissions()->attach($permissions->{'view-organization'});
        $user2->permissions()->attach($permissions->{'edit-organization'});
        $user2->permissions()->attach($permissions->{'update-organization'});
        $user2->permissions()->attach($permissions->{'delete-organization'});
        $user2->permissions()->attach($permissions->{'create-provider'});
        $user2->permissions()->attach($permissions->{'store-provider'});
        $user2->permissions()->attach($permissions->{'read-provider'});
        $user2->permissions()->attach($permissions->{'view-provider'});
        $user2->permissions()->attach($permissions->{'edit-provider'});
        $user2->permissions()->attach($permissions->{'update-provider'});
        $user2->permissions()->attach($permissions->{'delete-provider'});
        $user2->permissions()->attach($permissions->{'create-company'});
        $user2->permissions()->attach($permissions->{'store-company'});
        $user2->permissions()->attach($permissions->{'read-company'});
        $user2->permissions()->attach($permissions->{'view-company'});
        $user2->permissions()->attach($permissions->{'edit-company'});
        $user2->permissions()->attach($permissions->{'update-company'});
        $user2->permissions()->attach($permissions->{'delete-company'});
        $user2->permissions()->attach($permissions->{'create-employee'});
        $user2->permissions()->attach($permissions->{'store-employee'});
        $user2->permissions()->attach($permissions->{'read-employee'});
        $user2->permissions()->attach($permissions->{'view-employee'});
        $user2->permissions()->attach($permissions->{'edit-employee'});
        $user2->permissions()->attach($permissions->{'update-employee'});
        $user2->permissions()->attach($permissions->{'delete-employee'});

        $user3 = new User();
        $user3->name = 'Organization';
        $user3->email = 'organization@organization.com';
        $user3->password = Hash::make('organization');
        $user3->role = 'organization';
        $user3->save();
        $user3->roles()->attach($roles->organization);
        $user3->permissions()->attach($permissions->read);

        $user4 = new User();
        $user4->name = 'Provider';
        $user4->email = 'provider@provider.com';
        $user4->password = Hash::make('provider');
        $user4->role = 'provider';
        $user4->save();
        $user4->roles()->attach($roles->provider);
        $user4->permissions()->attach($permissions->read);

        $user5 = new User();
        $user5->name = 'Company';
        $user5->email = 'company@company.com';
        $user5->password = Hash::make('company');
        $user5->role = 'company';
        $user5->save();
        $user5->roles()->attach($roles->company);
        $user5->permissions()->attach($permissions->read);

        $user6 = new User();
        $user6->name = 'Employee';
        $user6->email = 'employee@employee.com';
        $user6->password = Hash::make('employee');
        $user6->role = 'employee';
        $user6->save();
        $user6->roles()->attach($roles->employee);
        $user6->permissions()->attach($permissions->read);
    }
}
