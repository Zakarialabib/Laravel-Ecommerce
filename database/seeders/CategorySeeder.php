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
                'name'       => 'Mobile',
                'description' => 'Mobile Phones',
                'status'      => 1,
            ],
            [
                'id'     => 2,
                'name'       => 'Laptop',
                'description' => 'Laptops',
                'status'      => 1,
            ],
            [
                'id'        => 3,
                'name'       => 'Tablet',
                'description' => 'Tablets',
                'status'      => 1,
            ],
            [
                'id'       => 4,
                'name'       => 'Camera',
                'description' => 'Cameras',
                'status'      => 1,
            ]
    ]);
    }
}