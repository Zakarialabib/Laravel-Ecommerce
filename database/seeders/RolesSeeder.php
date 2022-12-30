<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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
                'id'         => 1,
                'name'       => Role::ROLE_ADMIN,
                'guard_name' => Role::ROLE_ADMIN,
            ],
            [
                'id'         => 2,
                'name'       => Role::ROLE_CLIENT,
                'guard_name' => Role::ROLE_CLIENT,
            ],
        ];

        Role::insert($roles);
    }
}
