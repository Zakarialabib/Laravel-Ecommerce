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
                'id'    => 2,
                'name' => 'admin',
                'guard_name' => Role::ROLE_ADMIN,
            ],
            [
                'id'    => 3,
                'name' => 'client',
                'guard_name' => Role::ROLE_CLIENT,
            ],
        ];

        Role::insert($roles);
    }
}
