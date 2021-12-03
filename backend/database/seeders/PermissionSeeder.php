<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = new Permissions();
        $create->name = 'Create';
        $create->slug = 'create';
        $create->save();

        $store = new Permissions();
        $store->name = 'Store';
        $store->slug = 'store';
        $store->save();

        $read = new Permissions();
        $read->name = 'Read';
        $read->slug = 'read';
        $read->save();

        $view = new Permissions();
        $view->name = 'View';
        $view->slug = 'view';
        $view->save();

        $edit = new Permissions();
        $edit->name = 'Edit';
        $edit->slug = 'edit';
        $edit->save();

        $update = new Permissions();
        $update->name = 'Update';
        $update->slug = 'update';
        $update->save();

        $delete = new Permissions();
        $delete->name = 'Delete';
        $delete->slug = 'delete';
        $delete->save();

        // Manager
        $createManager = new Permissions();
        $createManager->name = 'Create Manager';
        $createManager->slug = 'create-manager';
        $createManager->save();

        $storeManager = new Permissions();
        $storeManager->name = 'Store Manager';
        $storeManager->slug = 'store-manager';
        $storeManager->save();

        $readManager = new Permissions();
        $readManager->name = 'Read Manager';
        $readManager->slug = 'read-manager';
        $readManager->save();

        $viewManager = new Permissions();
        $viewManager->name = 'View Manager';
        $viewManager->slug = 'view-manager';
        $viewManager->save();

        $editManager = new Permissions();
        $editManager->name = 'Edit Manager';
        $editManager->slug = 'edit-manager';
        $editManager->save();

        $updateManager = new Permissions();
        $updateManager->name = 'Update Manager';
        $updateManager->slug = 'update-manager';
        $updateManager->save();

        $delete = new Permissions();
        $delete->name = 'Delete Manager';
        $delete->slug = 'delete-manager';
        $delete->save();

        $readOnwManager = new Permissions();
        $readOnwManager->name = 'Read Own Manager';
        $readOnwManager->slug = 'read-own-manager';
        $readOnwManager->save();

        $viewOnwManager = new Permissions();
        $viewOnwManager->name = 'View Own Manager';
        $viewOnwManager->slug = 'view-own-manager';
        $viewOnwManager->save();

        $editOnwManager = new Permissions();
        $editOnwManager->name = 'Edit Own Manager';
        $editOnwManager->slug = 'edit-own-manager';
        $editOnwManager->save();

        $updateOnwManager = new Permissions();
        $updateOnwManager->name = 'Update Own Manager';
        $updateOnwManager->slug = 'update-own-manager';
        $updateOnwManager->save();

        // Organization
        $createOrganization = new Permissions();
        $createOrganization->name = 'Create Organization';
        $createOrganization->slug = 'create-organization';
        $createOrganization->save();

        $storeOrganization = new Permissions();
        $storeOrganization->name = 'Store Organization';
        $storeOrganization->slug = 'store-organization';
        $storeOrganization->save();

        $readOrganization = new Permissions();
        $readOrganization->name = 'Read Organization';
        $readOrganization->slug = 'read-organization';
        $readOrganization->save();

        $viewOrganization = new Permissions();
        $viewOrganization->name = 'View Organization';
        $viewOrganization->slug = 'view-organization';
        $viewOrganization->save();

        $editOrganization = new Permissions();
        $editOrganization->name = 'Edit Organization';
        $editOrganization->slug = 'edit-organization';
        $editOrganization->save();

        $updateOrganization = new Permissions();
        $updateOrganization->name = 'Update Organization';
        $updateOrganization->slug = 'update-organization';
        $updateOrganization->save();

        $deleteOrganization = new Permissions();
        $deleteOrganization->name = 'Delete Organization';
        $deleteOrganization->slug = 'delete-organization';
        $deleteOrganization->save();

        $readOnwOrganization = new Permissions();
        $readOnwOrganization->name = 'Read Own Organization';
        $readOnwOrganization->slug = 'read-own-organization';
        $readOnwOrganization->save();

        $viewOnwOrganization = new Permissions();
        $viewOnwOrganization->name = 'View Own Organization';
        $viewOnwOrganization->slug = 'view-own-organization';
        $viewOnwOrganization->save();

        $editOnwOrganization = new Permissions();
        $editOnwOrganization->name = 'Edit Own Organization';
        $editOnwOrganization->slug = 'edit-own-organization';
        $editOnwOrganization->save();

        $updateOnwOrganization = new Permissions();
        $updateOnwOrganization->name = 'Update Own Organization';
        $updateOnwOrganization->slug = 'update-own-organization';
        $updateOnwOrganization->save();

        // Provider
        $createProvider = new Permissions();
        $createProvider->name = 'Create Provider';
        $createProvider->slug = 'create-provider';
        $createProvider->save();

        $storeProvider = new Permissions();
        $storeProvider->name = 'Store Provider';
        $storeProvider->slug = 'store-provider';
        $storeProvider->save();

        $readProvider = new Permissions();
        $readProvider->name = 'Read Provider';
        $readProvider->slug = 'read-provider';
        $readProvider->save();

        $viewProvider = new Permissions();
        $viewProvider->name = 'View Provider';
        $viewProvider->slug = 'view-provider';
        $viewProvider->save();

        $editProvider = new Permissions();
        $editProvider->name = 'Edit Provider';
        $editProvider->slug = 'edit-provider';
        $editProvider->save();

        $updateProvider = new Permissions();
        $updateProvider->name = 'Update Provider';
        $updateProvider->slug = 'update-provider';
        $updateProvider->save();

        $deleteProvider = new Permissions();
        $deleteProvider->name = 'Delete Provider';
        $deleteProvider->slug = 'delete-provider';
        $deleteProvider->save();

        $readOnwProvider = new Permissions();
        $readOnwProvider->name = 'Read Own Provider';
        $readOnwProvider->slug = 'read-own-provider';
        $readOnwProvider->save();

        $viewOnwProvider = new Permissions();
        $viewOnwProvider->name = 'View Own Provider';
        $viewOnwProvider->slug = 'view-own-provider';
        $viewOnwProvider->save();

        $editOnwProvider = new Permissions();
        $editOnwProvider->name = 'Edit Own Provider';
        $editOnwProvider->slug = 'edit-own-provider';
        $editOnwProvider->save();

        $updateOnwProvider = new Permissions();
        $updateOnwProvider->name = 'Update Own Provider';
        $updateOnwProvider->slug = 'update-own-provider';
        $updateOnwProvider->save();

        // Company
        $createCompany = new Permissions();
        $createCompany->name = 'Create Company';
        $createCompany->slug = 'create-company';
        $createCompany->save();

        $storeCompany = new Permissions();
        $storeCompany->name = 'Store Company';
        $storeCompany->slug = 'store-company';
        $storeCompany->save();

        $readCompany = new Permissions();
        $readCompany->name = 'Read Company';
        $readCompany->slug = 'read-company';
        $readCompany->save();

        $viewCompany = new Permissions();
        $viewCompany->name = 'View Company';
        $viewCompany->slug = 'view-company';
        $viewCompany->save();

        $editCompany = new Permissions();
        $editCompany->name = 'Edit Company';
        $editCompany->slug = 'edit-company';
        $editCompany->save();

        $updateCompany = new Permissions();
        $updateCompany->name = 'Update Company';
        $updateCompany->slug = 'update-company';
        $updateCompany->save();

        $deleteCompany = new Permissions();
        $deleteCompany->name = 'Delete Company';
        $deleteCompany->slug = 'delete-company';
        $deleteCompany->save();

        $readOnwCompany = new Permissions();
        $readOnwCompany->name = 'Read Own Company';
        $readOnwCompany->slug = 'read-own-company';
        $readOnwCompany->save();

        $viewOnwCompany = new Permissions();
        $viewOnwCompany->name = 'View Own Company';
        $viewOnwCompany->slug = 'view-own-company';
        $viewOnwCompany->save();

        $editOnwCompany = new Permissions();
        $editOnwCompany->name = 'Edit Own Company';
        $editOnwCompany->slug = 'edit-own-company';
        $editOnwCompany->save();

        $updateOnwCompany = new Permissions();
        $updateOnwCompany->name = 'Update Own Company';
        $updateOnwCompany->slug = 'update-own-company';
        $updateOnwCompany->save();

        // Employee
        $createEmployee = new Permissions();
        $createEmployee->name = 'Create Employee';
        $createEmployee->slug = 'create-employee';
        $createEmployee->save();

        $storeEmployee = new Permissions();
        $storeEmployee->name = 'Store Employee';
        $storeEmployee->slug = 'store-employee';
        $storeEmployee->save();

        $readEmployee = new Permissions();
        $readEmployee->name = 'Read Employee';
        $readEmployee->slug = 'read-employee';
        $readEmployee->save();

        $viewEmployee = new Permissions();
        $viewEmployee->name = 'View Employee';
        $viewEmployee->slug = 'view-employee';
        $viewEmployee->save();

        $editEmployee = new Permissions();
        $editEmployee->name = 'Edit Employee';
        $editEmployee->slug = 'edit-employee';
        $editEmployee->save();

        $updateEmployee = new Permissions();
        $updateEmployee->name = 'Update Employee';
        $updateEmployee->slug = 'update-employee';
        $updateEmployee->save();

        $deleteEmployee = new Permissions();
        $deleteEmployee->name = 'Delete Employee';
        $deleteEmployee->slug = 'delete-employee';
        $deleteEmployee->save();

        $readOnwEmployee = new Permissions();
        $readOnwEmployee->name = 'Read Own Employee';
        $readOnwEmployee->slug = 'read-own-employee';
        $readOnwEmployee->save();

        $viewOnwEmployee = new Permissions();
        $viewOnwEmployee->name = 'View Own Employee';
        $viewOnwEmployee->slug = 'view-own-employee';
        $viewOnwEmployee->save();

        $editOnwEmployee = new Permissions();
        $editOnwEmployee->name = 'Edit Own Employee';
        $editOnwEmployee->slug = 'edit-own-employee';
        $editOnwEmployee->save();

        $updateOnwEmployee = new Permissions();
        $updateOnwEmployee->name = 'Update Own Employee';
        $updateOnwEmployee->slug = 'update-own-employee';
        $updateOnwEmployee->save();

    }
}
