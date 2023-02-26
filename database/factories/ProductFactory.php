<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'             => 'Samsung Galaxy S21',
            'description'      => 'Samsung Galaxy S21',
            'price'            => 1000,
            'image'            => 'samsung-galaxy-s21.jpg',
            'code'             => Str::random(5),
            'category_id'      => 1,
            'brand_id'         => 1,
            'slug'             => Str::slug('Samsung Galaxy S21'),
            'meta_title'       => 'Samsung Galaxy S21',
            'meta_description' => 'Samsung Galaxy S21',
            'meta_keywords'    => 'Samsung Galaxy S21',
            'status'           => 1,
        ];
    }
}
