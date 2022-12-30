<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'id'               => 1,
                'name'             => 'Samsung Galaxy S21',
                'description'      => 'Samsung Galaxy S21',
                'price'            => 1000,
                'image'            => 'samsung-galaxy-s21.jpg',
                'code'             => 'samsung-galaxy-s21',
                'category_id'      => 1,
                'brand_id'         => 1,
                'slug'             => Str::slug('Samsung Galaxy S21'),
                'meta_title'       => 'Samsung Galaxy S21',
                'meta_description' => 'Samsung Galaxy S21',
                'meta_keywords'    => 'Samsung Galaxy S21',
                'status'           => 1,
            ],
            [
                'id'               => 2,
                'name'             => 'Samsung Galaxy S21 Ultra',
                'description'      => 'Samsung Galaxy S21 Ultra',
                'price'            => 1000,
                'code'             => 'samsung-galaxy-s21-ultra',
                'image'            => 'samsung-galaxy-s21-ultra.jpg',
                'category_id'      => 1,
                'brand_id'         => 1,
                'slug'             => Str::slug('Samsung Galaxy S21 Ultra'),
                'meta_title'       => 'Samsung Galaxy S21 Ultra',
                'meta_description' => 'Samsung Galaxy S21 Ultra',
                'meta_keywords'    => 'Samsung Galaxy S21 Ultra',
                'status'           => 1,
            ],
            [
                'id'               => 3,
                'name'             => 'Samsung Galaxy S21 Plus',
                'description'      => 'Samsung Galaxy S21 Plus',
                'price'            => 1000,
                'code'             => 'samsung-galaxy-s21-plus',
                'image'            => 'samsung-galaxy-s21-plus.jpg',
                'category_id'      => 1,
                'brand_id'         => 1,
                'slug'             => Str::slug('Samsung Galaxy S21 Plus'),
                'meta_title'       => 'Samsung Galaxy S21 Plus',
                'meta_description' => 'Samsung Galaxy S21 Plus',
                'meta_keywords'    => 'Samsung Galaxy S21 Plus',
                'status'           => 1,
            ],
            [
                'id'               => 4,
                'name'             => 'Samsung Galaxy S20 FE',
                'description'      => 'Samsung Galaxy S20 FE',
                'price'            => 1000,
                'code'             => 'samsung-galaxy-s20-fe',
                'image'            => 'samsung-galaxy-s20-fe.jpg',
                'category_id'      => 1,
                'brand_id'         => 1,
                'slug'             => Str::slug('Samsung Galaxy S20 FE'),
                'meta_title'       => 'Samsung Galaxy S20 FE',
                'meta_description' => 'Samsung Galaxy S20 FE',
                'meta_keywords'    => 'Samsung Galaxy S20 FE',
                'status'           => 1,
            ],
        ]);
    }
}
