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
                'name'       => 'Montre Homme',
                'image'      => 'categorie.png',
            ],
            [
                'id'     => 2,
                'name'       => 'Montre Femme',
                'image'      => 'categorie.png',
            ],
            [
                'id'        => 3,
                'name'       => 'Class',
                'image'      => 'categorie.png',
            ],
            [
                'id'       => 4,
                'name'       => 'Extreme',
                'image'      => 'categorie.png',
            ]
    ]);
    }
}