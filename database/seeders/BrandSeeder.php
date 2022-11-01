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
            'link'       => 'https://www.apple.com/',
            'description' => 'Apple Inc. is an American multinational technology company headquartered in Cupertino, California, that designs, develops, and sells consumer electronics, computer software, and online services. It is considered one of the Big Four of technology along with Amazon, Google, and Facebook.',
            'image'      => 'apple.png',
            'meta_title' => 'Apple',
            'meta_description' => 'Apple Inc. is an American multinational technology company headquartered in Cupertino, ',
            ],
            [
            'id'           => 2,
            'name'        => 'Samsung',
            'link'       => 'https://www.samsung.com/',
            'description' => 'Samsung is a South Korean multinational conglomerate headquartered in Samsung Town, Seoul. It comprises numerous affiliated businesses, most of them united under the Samsung brand, and is the largest South Korean chaebol (business conglomerate).',
            'image'       => 'https://www.samsung.com/etc/designs/smg/global/imgs/samsung-logo.png',
            'meta_title' => 'Samsung',
            'meta_description' => 'Samsung is a South Korean multinational conglomerate headquartered in Samsung Town, Seoul.',
            ],
            [
            'id'           => 3,
            'name'        => 'Xiaomi',
            'link'       => 'https://www.mi.com/',
            'description' => 'Xiaomi Corporation is a Chinese electronics company headquartered in Beijing. Xiaomi makes and invests in smartphones, mobile apps, laptops, bags, earphones, shoes, fitness bands, and many other products.',
            'image'       => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Xiaomi_logo.svg/1200px-Xiaomi_logo.svg.png',
            'meta_title' => 'Xiaomi',
            'meta_description' => 'Xiaomi Corporation is a Chinese electronics company headquartered in Beijing.',
            ],
            [
            'id'           => 4,
            'name'        => 'Oppo',
            'link'       => 'https://www.oppo.com/',
            'description' => 'Oppo Electronics Corp., commonly referred to as Oppo, is a Chinese consumer electronics and mobile communications company headquartered in Dongguan, Guangdong, China.',
            'image'       => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Oppo_logo.svg/1200px-Oppo_logo.svg.png',
            'meta_title' => 'Oppo',
            'meta_description' => 'Oppo Electronics Corp., commonly referred to as Oppo, ',
            ],
        ]);
        
    }
}