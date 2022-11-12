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
                'name'       => 'Sport',
                'image'      => 'https://via.placeholder.com/150',
            ],
            [
                'id'     => 2,
                'code' => 2,
                'name'       => 'Vintage',
                'image'      => 'https://via.placeholder.com/150',
            ],
            [
                'id'        => 3,
                'code' => 3,
                'name'       => 'Class',
                'image'      => 'https://via.placeholder.com/150',
            ],
            [
                'id'       => 4,
                'code' => 4,
                'name'       => 'Extreme',
                'image'      => 'https://via.placeholder.com/150',
            ]
    ]);
    }
}