<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeaturedBanner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FeaturedBannerSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        FeaturedBanner::insert([
            [
                'title' => 'Featured Banner Title',
                'details' => 'Featured Banner Details',
                'image' => 'featured_banner.jpg',
                'status' => 1,
                'featured' => 1,
                'product_id' => 1,
                'language_id' => 1,
            ],
            [
                'title' => 'Featured Banner Title',
                'details' => 'Featured Banner Details',
                'image' => 'featured_banner.jpg',
                'status' => 1,
                'featured' => 1,
                'product_id' => 1,
                'language_id' => 1,
            ],
            [
                'title' => 'Featured Banner Title',
                'details' => 'Featured Banner Details',
                'image' => 'featured_banner.jpg',
                'status' => 1,
                'featured' => 1,
                'product_id' => 1,
                'language_id' => 1,
            ],
        ]);
    }    
    }