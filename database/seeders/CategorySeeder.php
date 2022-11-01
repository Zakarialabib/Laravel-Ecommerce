<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'id' => 1,
                'code' => 1,
                'name'       => 'Mobile',
                'image'      => 'https://via.placeholder.com/150',
            ],
            [
                'id'     => 2,
                'code' => 2,
                'name'       => 'Laptop',
                'image'      => 'https://via.placeholder.com/150',
            ],
            [
                'id'        => 3,
                'code' => 3,
                'name'       => 'Tablet',
                'image'      => 'https://via.placeholder.com/150',
            ],
            [
                'id'       => 4,
                'code' => 4,
                'name'       => 'Camera',
                'image'      => 'https://via.placeholder.com/150',
            ]
    ]);
    }
}