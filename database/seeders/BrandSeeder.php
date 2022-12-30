<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'id'               => 1,
                'name'             => 'Casio',
                'slug'             => Str::slug('Apple'),
                'description'      => 'Casio is a Japanese multinational consumer electronics and commercial electronics manufacturing company headquartered in Shibuya, Tokyo, Japan. Its products include calculators, mobile phones, digital cameras, electronic musical instruments, analogue and digital watches, and other electronic products.',
                'image'            => 'casio.png',
                'meta_title'       => Str::limit('Apple', 60),
                'meta_description' => Str::limit('Casio is a Japanese multinational consumer electronics and commercial electronics manufacturing company headquartered in Shibuya, Tokyo, Japan. Its products include calculators, mobile phones, digital cameras, electronic musical instruments, analogue and digital watches, and other electronic products.', 160),
            ],
            [
                'id'               => 2,
                'name'             => 'Swatch',
                'slug'             => Str::slug('Swatch'),
                'description'      => 'Swatch is a Swiss watchmaker based in Biel/Bienne that designs, manufactures, distributes, and sells finished watches, watch movements, and watch-related products. The company is a subsidiary of the Swatch Group, the world’s largest watchmaker.',
                'image'            => 'swatch.png',
                'meta_title'       => Str::limit('Swatch', 60),
                'meta_description' => Str::limit('Swatch is a Swiss watchmaker based in Biel/Bienne that designs, manufactures, distributes, and sells finished watches, watch movements, and watch-related products. The company is a subsidiary of the Swatch Group, the world’s largest watchmaker.', 160),
            ],
            [
                'id'               => 3,
                'name'             => 'Fossil',
                'slug'             => Str::slug('Fossil'),
                'description'      => 'Xiaomi Corporation is a Chinese electronics company headquartered in Beijing. Xiaomi makes and invests in smartphones, mobile apps, laptops, bags, earphones, shoes, fitness bands, and many other products.',
                'image'            => 'fossil.png',
                'meta_title'       => Str::limit('Fossil', 60),
                'meta_description' => Str::limit('Xiaomi Corporation is a Chinese electronics company headquartered in Beijing. Xiaomi makes and invests in smartphones, mobile apps, laptops, bags, earphones, shoes, fitness bands, and many other products.', 160),
            ],

            [
                'id'               => 4,
                'name'             => 'Seiko',
                'slug'             => Str::slug('Seiko'),
                'description'      => 'Seiko is a Japanese watchmaker founded in 1881. It is one of the largest and most famous watchmakers in the world. Seiko is a subsidiary of the Seiko Holdings Corporation, which is owned by the parent company, the Seiko Group.',
                'image'            => 'seiko.png',
                'meta_title'       => Str::limit('Seiko', 60),
                'meta_description' => Str::limit('Seiko is a Japanese watchmaker founded in 1881. It is one of the largest and most famous watchmakers in the world. Seiko is a subsidiary of the Seiko Holdings Corporation, which is owned by the parent company, the Seiko Group.', 160),
            ],
        ]);
    }
}
