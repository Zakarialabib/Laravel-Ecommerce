<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id'             => 999,
            'first_name'     => 'Admin',
            'last_name'      => 'Admin',
            'email'          => 'admin@gmail.com',
            'password'       => bcrypt('password'),
            'zip'            => '12345',
            'city'           => 'Casablanca',
            'state'          => 'Casablanca',
            'country'        => 'Morocco',
            'address'        => 'Casablanca',
            'phone'          => '123456789',
            'statut'         => 1,
            'role_id'        => 1,
            'remember_token' => null,
            'created_at'     => now(),
        ]);
    }
}
