<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;
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
            'id'           => 1,
            'name'        => 'Apple',
            'description' => 'Apple is an American multinational technology company headquartered in Cupertino, California, that designs, develops, and sells consumer electronics, computer software, and online services.',
            'image'       => 'https://www.apple.com/ac/structured-data/images/open_graph_logo.png?201809210816',
            'status'      => 1,
            ],
            [
            'id'           => 2,
            'name'        => 'Samsung',
            'description' => 'Samsung is a South Korean multinational conglomerate headquartered in Samsung Town, Seoul. It comprises numerous affiliated businesses, most of them united under the Samsung brand, and is the largest South Korean chaebol (business conglomerate).',
            'image'       => 'https://www.samsung.com/etc/designs/smg/global/imgs/samsung-logo.png',
            'status'      => 1,
            ],
            [
            'id'           => 3,
            'name'        => 'Xiaomi',
            'description' => 'Xiaomi Corporation is a Chinese electronics company headquartered in Beijing. Xiaomi makes and invests in smartphones, mobile apps, laptops, bags, earphones, shoes, fitness bands, and many other products.',
            'image'       => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Xiaomi_logo.svg/1200px-Xiaomi_logo.svg.png',
            'status'      => 1,
            ],
            [
            'id'           => 4,
            'name'        => 'Oppo',
            'description' => 'Oppo Electronics Corp., commonly referred to as Oppo, is a Chinese consumer electronics and mobile communications company headquartered in Dongguan, Guangdong, China.',
            'image'       => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Oppo_logo.svg/1200px-Oppo_logo.svg.png',
            'status'      => 1,
            ],
        ]);
        
    }
}