<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(1);
        User::findOrFail(3)->roles()->sync(2);
        User::findOrFail(4)->roles()->sync(2);
        User::findOrFail(999)->roles()->sync(1);
    }
}
