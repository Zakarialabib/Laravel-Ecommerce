<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FeaturedBanner;
use Illuminate\Database\Seeder;

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
                'title'       => 'Best Offer For You',
                'details'     => 'Offer this week',
                'image'       => 'featured_banner.jpg',
                'status'      => 1,
                'featured'    => 1,
                'product_id'  => 1,
                'language_id' => 1,
            ],
            [
                'title'       => 'Featured Banner Title',
                'details'     => 'Featured Banner Details',
                'image'       => 'featured_banner.jpg',
                'status'      => 1,
                'featured'    => 1,
                'product_id'  => 1,
                'language_id' => 1,
            ],
            [
                'title'       => 'Featured Banner Title',
                'details'     => 'Featured Banner Details',
                'image'       => 'featured_banner.jpg',
                'status'      => 1,
                'featured'    => 1,
                'product_id'  => 1,
                'language_id' => 1,
            ],
        ]);
    }
}
