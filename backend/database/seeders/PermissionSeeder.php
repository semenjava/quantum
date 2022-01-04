<?php

namespace Database\Seeders;

use Kodeine\Acl\Models\Eloquent\Permission;
use Illuminate\Database\Seeder;
use App\Traits\RolesGet;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = RolesGet::getRoles();

        Permission::query()->truncate();

        $create = new Permission();
        $create->name = 'Create';
        $create->slug = 'create';
        $create->save();
        $create->roles()->attach($roles->get('superadmin'));
        $create->roles()->attach($roles->get('manager'));

        $store = new Permission();
        $store->name = 'Store';
        $store->slug = 'store';
        $store->save();
        $store->roles()->attach($roles->get('superadmin'));
        $store->roles()->attach($roles->get('manager'));

        $read = new Permission();
        $read->name = 'Read';
        $read->slug = 'read';
        $read->save();
        $read->roles()->attach($roles->get('superadmin'));
        $read->roles()->attach($roles->get('manager'));

        $view = new Permission();
        $view->name = 'View';
        $view->slug = 'view';
        $view->save();
        $view->roles()->attach($roles->get('superadmin'));
        $view->roles()->attach($roles->get('manager'));

        $edit = new Permission();
        $edit->name = 'Edit';
        $edit->slug = 'edit';
        $edit->save();
        $edit->roles()->attach($roles->get('superadmin'));
        $edit->roles()->attach($roles->get('manager'));

        $update = new Permission();
        $update->name = 'Update';
        $update->slug = 'update';
        $update->save();
        $update->roles()->attach($roles->get('superadmin'));
        $update->roles()->attach($roles->get('manager'));

        $delete = new Permission();
        $delete->name = 'Delete';
        $delete->slug = 'delete';
        $delete->save();
        $delete->roles()->attach($roles->get('superadmin'));
        $delete->roles()->attach($roles->get('manager'));

        // Manager
        $createManager = new Permission();
        $createManager->name = 'Create Manager';
        $createManager->slug = 'create-manager';
        $createManager->save();
        $createManager->roles()->attach($roles->get('superadmin'));

        $storeManager = new Permission();
        $storeManager->name = 'Store Manager';
        $storeManager->slug = 'store-manager';
        $storeManager->save();
        $storeManager->roles()->attach($roles->get('superadmin'));

        $readManager = new Permission();
        $readManager->name = 'Read Manager';
        $readManager->slug = 'read-manager';
        $readManager->save();
        $readManager->roles()->attach($roles->get('superadmin'));

        $viewManager = new Permission();
        $viewManager->name = 'View Manager';
        $viewManager->slug = 'view-manager';
        $viewManager->save();
        $viewManager->roles()->attach($roles->get('superadmin'));

        $editManager = new Permission();
        $editManager->name = 'Edit Manager';
        $editManager->slug = 'edit-manager';
        $editManager->save();
        $editManager->roles()->attach($roles->get('superadmin'));

        $updateManager = new Permission();
        $updateManager->name = 'Update Manager';
        $updateManager->slug = 'update-manager';
        $updateManager->save();
        $updateManager->roles()->attach($roles->get('superadmin'));

        $delete = new Permission();
        $delete->name = 'Delete Manager';
        $delete->slug = 'delete-manager';
        $delete->save();
        $delete->roles()->attach($roles->get('superadmin'));

        $readOnwManager = new Permission();
        $readOnwManager->name = 'Read Own Manager';
        $readOnwManager->slug = 'read-own-manager';
        $readOnwManager->save();
        $readOnwManager->roles()->attach($roles->get('superadmin'));
        $readOnwManager->roles()->attach($roles->get('manager'));

        $viewOnwManager = new Permission();
        $viewOnwManager->name = 'View Own Manager';
        $viewOnwManager->slug = 'view-own-manager';
        $viewOnwManager->save();
        $viewOnwManager->roles()->attach($roles->get('superadmin'));
        $viewOnwManager->roles()->attach($roles->get('manager'));

        $editOnwManager = new Permission();
        $editOnwManager->name = 'Edit Own Manager';
        $editOnwManager->slug = 'edit-own-manager';
        $editOnwManager->save();
        $editOnwManager->roles()->attach($roles->get('superadmin'));
        $editOnwManager->roles()->attach($roles->get('manager'));

        $updateOnwManager = new Permission();
        $updateOnwManager->name = 'Update Own Manager';
        $updateOnwManager->slug = 'update-own-manager';
        $updateOnwManager->save();
        $updateOnwManager->roles()->attach($roles->get('superadmin'));
        $updateOnwManager->roles()->attach($roles->get('manager'));

        // facility
        $createOrganization = new Permission();
        $createOrganization->name = 'Create Facility';
        $createOrganization->slug = 'create-facility';
        $createOrganization->save();
        $createOrganization->roles()->attach($roles->get('superadmin'));
        $createOrganization->roles()->attach($roles->get('manager'));

        $storeOrganization = new Permission();
        $storeOrganization->name = 'Store Facility';
        $storeOrganization->slug = 'store-facility';
        $storeOrganization->save();
        $storeOrganization->roles()->attach($roles->get('superadmin'));
        $storeOrganization->roles()->attach($roles->get('manager'));

        $readOrganization = new Permission();
        $readOrganization->name = 'Read Facility';
        $readOrganization->slug = 'read-facility';
        $readOrganization->save();
        $readOrganization->roles()->attach($roles->get('superadmin'));
        $readOrganization->roles()->attach($roles->get('manager'));
        $readOrganization->roles()->attach($roles->get('facility'));

        $viewOrganization = new Permission();
        $viewOrganization->name = 'View Facility';
        $viewOrganization->slug = 'view-facility';
        $viewOrganization->save();
        $viewOrganization->roles()->attach($roles->get('superadmin'));
        $viewOrganization->roles()->attach($roles->get('manager'));

        $editOrganization = new Permission();
        $editOrganization->name = 'Edit Facility';
        $editOrganization->slug = 'edit-facility';
        $editOrganization->save();
        $editOrganization->roles()->attach($roles->get('superadmin'));
        $editOrganization->roles()->attach($roles->get('manager'));

        $updateOrganization = new Permission();
        $updateOrganization->name = 'Update Facility';
        $updateOrganization->slug = 'update-facility';
        $updateOrganization->save();
        $updateOrganization->roles()->attach($roles->get('superadmin'));
        $updateOrganization->roles()->attach($roles->get('manager'));

        $deleteOrganization = new Permission();
        $deleteOrganization->name = 'Delete Facility';
        $deleteOrganization->slug = 'delete-facility';
        $deleteOrganization->save();
        $deleteOrganization->roles()->attach($roles->get('superadmin'));
        $deleteOrganization->roles()->attach($roles->get('manager'));

        $readOnwOrganization = new Permission();
        $readOnwOrganization->name = 'Read Own Facility';
        $readOnwOrganization->slug = 'read-own-facility';
        $readOnwOrganization->save();
        $readOnwOrganization->roles()->attach($roles->get('superadmin'));
        $readOnwOrganization->roles()->attach($roles->get('facility'));

        $viewOnwOrganization = new Permission();
        $viewOnwOrganization->name = 'View Own Facility';
        $viewOnwOrganization->slug = 'view-own-facility';
        $viewOnwOrganization->save();
        $viewOnwOrganization->roles()->attach($roles->get('superadmin'));
        $viewOnwOrganization->roles()->attach($roles->get('facility'));

        $editOnwOrganization = new Permission();
        $editOnwOrganization->name = 'Edit Own Facility';
        $editOnwOrganization->slug = 'edit-own-facility';
        $editOnwOrganization->save();
        $editOnwOrganization->roles()->attach($roles->get('superadmin'));
        $editOnwOrganization->roles()->attach($roles->get('facility'));

        $updateOnwOrganization = new Permission();
        $updateOnwOrganization->name = 'Update Own Facility';
        $updateOnwOrganization->slug = 'update-own-facility';
        $updateOnwOrganization->save();
        $updateOnwOrganization->roles()->attach($roles->get('superadmin'));
        $updateOnwOrganization->roles()->attach($roles->get('facility'));

        // Provider
        $createProvider = new Permission();
        $createProvider->name = 'Create Provider';
        $createProvider->slug = 'create-provider';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('manager'));

        $storeProvider = new Permission();
        $storeProvider->name = 'Store Provider';
        $storeProvider->slug = 'store-provider';
        $storeProvider->save();
        $storeProvider->roles()->attach($roles->get('superadmin'));
        $storeProvider->roles()->attach($roles->get('manager'));

        $readProvider = new Permission();
        $readProvider->name = 'Read Provider';
        $readProvider->slug = 'read-provider';
        $readProvider->save();
        $readProvider->roles()->attach($roles->get('superadmin'));
        $readProvider->roles()->attach($roles->get('manager'));
        $readProvider->roles()->attach($roles->get('facility'));

        $viewProvider = new Permission();
        $viewProvider->name = 'View Provider';
        $viewProvider->slug = 'view-provider';
        $viewProvider->save();
        $viewProvider->roles()->attach($roles->get('superadmin'));
        $viewProvider->roles()->attach($roles->get('manager'));
        $viewProvider->roles()->attach($roles->get('facility'));

        $editProvider = new Permission();
        $editProvider->name = 'Edit Provider';
        $editProvider->slug = 'edit-provider';
        $editProvider->save();
        $editProvider->roles()->attach($roles->get('superadmin'));
        $editProvider->roles()->attach($roles->get('manager'));

        $updateProvider = new Permission();
        $updateProvider->name = 'Update Provider';
        $updateProvider->slug = 'update-provider';
        $updateProvider->save();
        $updateProvider->roles()->attach($roles->get('superadmin'));
        $updateProvider->roles()->attach($roles->get('manager'));

        $deleteProvider = new Permission();
        $deleteProvider->name = 'Delete Provider';
        $deleteProvider->slug = 'delete-provider';
        $deleteProvider->save();
        $deleteProvider->roles()->attach($roles->get('superadmin'));
        $deleteProvider->roles()->attach($roles->get('manager'));

        $readOnwProvider = new Permission();
        $readOnwProvider->name = 'Read Own Provider';
        $readOnwProvider->slug = 'read-own-provider';
        $readOnwProvider->save();
        $readOnwProvider->roles()->attach($roles->get('superadmin'));
        $readOnwProvider->roles()->attach($roles->get('provider'));

        $viewOnwProvider = new Permission();
        $viewOnwProvider->name = 'View Own Provider';
        $viewOnwProvider->slug = 'view-own-provider';
        $viewOnwProvider->save();
        $viewOnwProvider->roles()->attach($roles->get('superadmin'));
        $viewOnwProvider->roles()->attach($roles->get('provider'));

        $editOnwProvider = new Permission();
        $editOnwProvider->name = 'Edit Own Provider';
        $editOnwProvider->slug = 'edit-own-provider';
        $editOnwProvider->save();
        $editOnwProvider->roles()->attach($roles->get('superadmin'));
        $editOnwProvider->roles()->attach($roles->get('provider'));

        $updateOnwProvider = new Permission();
        $updateOnwProvider->name = 'Update Own Provider';
        $updateOnwProvider->slug = 'update-own-provider';
        $updateOnwProvider->save();
        $updateOnwProvider->roles()->attach($roles->get('superadmin'));
        $updateOnwProvider->roles()->attach($roles->get('provider'));

        // Provider
        $createProvider = new Permission();
        $createProvider->name = 'Create Own Provider Address ';
        $createProvider->slug = 'create-own-provider-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('provider'));

        $createProvider = new Permission();
        $createProvider->name = 'Update Own Provider Address ';
        $createProvider->slug = 'update-own-provider-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('provider'));

        $createProvider = new Permission();
        $createProvider->name = 'Store Provider Address ';
        $createProvider->slug = 'store-provider-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('provider'));

        $createProvider = new Permission();
        $createProvider->name = 'Store Facility Address ';
        $createProvider->slug = 'store-facility-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('facility'));

        $createProvider = new Permission();
        $createProvider->name = 'Store Company Address ';
        $createProvider->slug = 'store-company-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('company'));

        $createProvider = new Permission();
        $createProvider->name = 'Store Employee Address ';
        $createProvider->slug = 'store-employee-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('employee'));

        $createProvider = new Permission();
        $createProvider->name = 'Update Provider Address ';
        $createProvider->slug = 'update-provider-address';
        $createProvider->save();
        $createProvider->roles()->attach($roles->get('superadmin'));
        $createProvider->roles()->attach($roles->get('provider'));

        // Company
        $createCompany = new Permission();
        $createCompany->name = 'Create Company';
        $createCompany->slug = 'create-company';
        $createCompany->save();
        $createCompany->roles()->attach($roles->get('superadmin'));
        $createCompany->roles()->attach($roles->get('manager'));

        $storeCompany = new Permission();
        $storeCompany->name = 'Store Company';
        $storeCompany->slug = 'store-company';
        $storeCompany->save();
        $storeCompany->roles()->attach($roles->get('superadmin'));
        $storeCompany->roles()->attach($roles->get('manager'));

        $readCompany = new Permission();
        $readCompany->name = 'Read Company';
        $readCompany->slug = 'read-company';
        $readCompany->save();
        $readCompany->roles()->attach($roles->get('superadmin'));
        $readCompany->roles()->attach($roles->get('manager'));
        $readCompany->roles()->attach($roles->get('facility'));
        $readCompany->roles()->attach($roles->get('provider'));

        $viewCompany = new Permission();
        $viewCompany->name = 'View Company';
        $viewCompany->slug = 'view-company';
        $viewCompany->save();
        $viewCompany->roles()->attach($roles->get('superadmin'));
        $viewCompany->roles()->attach($roles->get('manager'));
        $viewCompany->roles()->attach($roles->get('facility'));
        $viewCompany->roles()->attach($roles->get('provider'));

        $editCompany = new Permission();
        $editCompany->name = 'Edit Company';
        $editCompany->slug = 'edit-company';
        $editCompany->save();
        $editCompany->roles()->attach($roles->get('superadmin'));
        $editCompany->roles()->attach($roles->get('manager'));

        $updateCompany = new Permission();
        $updateCompany->name = 'Update Company';
        $updateCompany->slug = 'update-company';
        $updateCompany->save();
        $updateCompany->roles()->attach($roles->get('superadmin'));
        $updateCompany->roles()->attach($roles->get('manager'));

        $deleteCompany = new Permission();
        $deleteCompany->name = 'Delete Company';
        $deleteCompany->slug = 'delete-company';
        $deleteCompany->save();
        $deleteCompany->roles()->attach($roles->get('superadmin'));
        $deleteCompany->roles()->attach($roles->get('manager'));

        $readOnwCompany = new Permission();
        $readOnwCompany->name = 'Read Own Company';
        $readOnwCompany->slug = 'read-own-company';
        $readOnwCompany->save();
        $readOnwCompany->roles()->attach($roles->get('superadmin'));
        $readOnwCompany->roles()->attach($roles->get('company'));

        $viewOnwCompany = new Permission();
        $viewOnwCompany->name = 'View Own Company';
        $viewOnwCompany->slug = 'view-own-company';
        $viewOnwCompany->save();
        $viewOnwCompany->roles()->attach($roles->get('superadmin'));
        $viewOnwCompany->roles()->attach($roles->get('company'));

        $editOnwCompany = new Permission();
        $editOnwCompany->name = 'Edit Own Company';
        $editOnwCompany->slug = 'edit-own-company';
        $editOnwCompany->save();
        $editOnwCompany->roles()->attach($roles->get('superadmin'));
        $editOnwCompany->roles()->attach($roles->get('company'));

        $updateOnwCompany = new Permission();
        $updateOnwCompany->name = 'Update Own Company';
        $updateOnwCompany->slug = 'update-own-company';
        $updateOnwCompany->save();
        $updateOnwCompany->roles()->attach($roles->get('superadmin'));
        $updateOnwCompany->roles()->attach($roles->get('company'));

        // Employee
        $createEmployee = new Permission();
        $createEmployee->name = 'Create Employee';
        $createEmployee->slug = 'create-employee';
        $createEmployee->save();
        $createEmployee->roles()->attach($roles->get('superadmin'));
        $createEmployee->roles()->attach($roles->get('manager'));

        $storeEmployee = new Permission();
        $storeEmployee->name = 'Store Employee';
        $storeEmployee->slug = 'store-employee';
        $storeEmployee->save();
        $storeEmployee->roles()->attach($roles->get('superadmin'));
        $storeEmployee->roles()->attach($roles->get('manager'));

        $readEmployee = new Permission();
        $readEmployee->name = 'Read Employee';
        $readEmployee->slug = 'read-employee';
        $readEmployee->save();
        $readEmployee->roles()->attach($roles->get('superadmin'));
        $readEmployee->roles()->attach($roles->get('manager'));
        $readEmployee->roles()->attach($roles->get('facility'));
        $readEmployee->roles()->attach($roles->get('provider'));
        $readEmployee->roles()->attach($roles->get('company'));

        $viewEmployee = new Permission();
        $viewEmployee->name = 'View Employee';
        $viewEmployee->slug = 'view-employee';
        $viewEmployee->save();
        $viewEmployee->roles()->attach($roles->get('superadmin'));
        $viewEmployee->roles()->attach($roles->get('manager'));
        $viewEmployee->roles()->attach($roles->get('facility'));
        $viewEmployee->roles()->attach($roles->get('provider'));
        $viewEmployee->roles()->attach($roles->get('company'));

        $editEmployee = new Permission();
        $editEmployee->name = 'Edit Employee';
        $editEmployee->slug = 'edit-employee';
        $editEmployee->save();
        $editEmployee->roles()->attach($roles->get('superadmin'));
        $editEmployee->roles()->attach($roles->get('manager'));

        $updateEmployee = new Permission();
        $updateEmployee->name = 'Update Employee';
        $updateEmployee->slug = 'update-employee';
        $updateEmployee->save();
        $updateEmployee->roles()->attach($roles->get('superadmin'));
        $updateEmployee->roles()->attach($roles->get('manager'));

        $deleteEmployee = new Permission();
        $deleteEmployee->name = 'Delete Employee';
        $deleteEmployee->slug = 'delete-employee';
        $deleteEmployee->save();
        $deleteEmployee->roles()->attach($roles->get('superadmin'));
        $deleteEmployee->roles()->attach($roles->get('manager'));

        $readOnwEmployee = new Permission();
        $readOnwEmployee->name = 'Read Own Employee';
        $readOnwEmployee->slug = 'read-own-employee';
        $readOnwEmployee->save();
        $readOnwEmployee->roles()->attach($roles->get('superadmin'));
        $readOnwEmployee->roles()->attach($roles->get('employee'));

        $viewOnwEmployee = new Permission();
        $viewOnwEmployee->name = 'View Own Employee';
        $viewOnwEmployee->slug = 'view-own-employee';
        $viewOnwEmployee->save();
        $viewOnwEmployee->roles()->attach($roles->get('superadmin'));
        $viewOnwEmployee->roles()->attach($roles->get('employee'));

        $editOnwEmployee = new Permission();
        $editOnwEmployee->name = 'Edit Own Employee';
        $editOnwEmployee->slug = 'edit-own-employee';
        $editOnwEmployee->save();
        $editOnwEmployee->roles()->attach($roles->get('superadmin'));
        $editOnwEmployee->roles()->attach($roles->get('employee'));

        $updateOnwEmployee = new Permission();
        $updateOnwEmployee->name = 'Update Own Employee';
        $updateOnwEmployee->slug = 'update-own-employee';
        $updateOnwEmployee->save();
        $updateOnwEmployee->roles()->attach($roles->get('superadmin'));
        $updateOnwEmployee->roles()->attach($roles->get('employee'));
    }
}
