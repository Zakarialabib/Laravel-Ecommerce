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
                'name'  => 'Montre Homme',
                'image' => 'categorie.png',
            ],
            [
                'id'    => 2,
                'name'  => 'Montre Femme',
                'image' => 'categorie.png',
            ],
            [
                'id'    => 3,
                'name'  => 'Class',
                'image' => 'categorie.png',
            ],
            [
                'id'    => 4,
                'name'  => 'Extreme',
                'image' => 'categorie.png',
            ],
        ]);
    }
}
