<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

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
                'id'    => 1,
                'name'  => 'Men',
                'slug'  => 'men',
                'image' => 'categorie.png',
            ],
            [
                'id'    => 2,
                'name'  => 'Women',
                'slug'  => 'Women',
                'image' => 'categorie.png',
            ],
            [
                'id'    => 3,
                'name'  => 'Electronics',
                'slug'  => 'Electronics',
                'image' => 'categorie.png',
            ],
            [
                'id'    => 4,
                'name'  => 'Sport',
                'slug'  => 'sport',
                'image' => 'categorie.png',
            ],
        ]);
    }
}
