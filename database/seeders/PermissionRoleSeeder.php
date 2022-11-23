<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        // give superadmin and admin all permissions

        $superAdmin = Role::where('name', 'Super Admin')->first();
        $superAdmin->syncPermissions($permissions);

        $admin = Role::where('name', Role::ROLE_ADMIN)->first();
        $admin->syncPermissions($permissions);
    }
}
