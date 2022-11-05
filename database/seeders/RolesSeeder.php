<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            [
                'id'    => 2,
                'name' => Role::ROLE_ADMIN,
                'guard_name' => Role::ROLE_ADMIN,
            ],
            [
                'id'    => 3,
                'name' => Role::ROLE_CLIENT,
                'guard_name' => Role::ROLE_CLIENT,
            ],
        ];

        Role::insert($roles);
    }
}
