<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Traits\RolesGet;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $roles = RolesGet::getRoles();

        foreach ($roles as $slug => $role) {
            $data[$slug] = [];
            foreach ($role->permissions as $permission) {
                $data[$slug][] = RolesGet::slug($permission->slug);
            }
        }

        dd($data);
    }
}
