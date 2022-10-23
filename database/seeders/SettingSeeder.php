<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
       Settings::insert([
           [
               'key' => 'site_title',
               'value' => 'Laravel Ecommerce',
           ],
           [
               'key' => 'site_description',
               'value' => 'Laravel Ecommerce',
           ],
           [
               'key' => 'site_eywords',
               'value' => 'Laravel Ecommerce',
           ],
           [
               'key' => 'site_logo',
               'value' => 'logo.png',
           ],
           [
               'key' => 'site_favicon',
               'value' => 'favicon.png',
           ],
           [
               'key' => 'site_email',
               'value' => 'app@mail.com',
            ],
           [
               'key' => 'site_phone',
               'value' => '0000000000',
            ],
            [
                'key' => 'site_address',
                'value' => 'Morocco',
            ],
            [
                'key' => 'facebook_link',
                'value' => '#',
            ],
            [
                'key' => 'twitter_link',
                'value' => '#',
            ],
            [
                'key' => 'instagram_link',
                'value' => '#',
            ],
            [
                'key' => 'youtube_link',
                'value' => '#',
            ],
            [
                'key' => 'site_status',
                'value' => '1',
            ],
            [
                'key' => 'site_maintenance_message',
                'value' => 'Site is under maintenance',
            ],
            [
                'key' => 'site_currency',
                'value' => 'USD',
            ],
            [
                'key' => 'site_currency_symbol',
                'value' => 'DH',
            ],
            [
                'key' => 'site_currency_position',
                'value' => 'left',
            ],
            [
                'key' => 'site_tax',
                'value' => '0',
            ],
            [
                'key' => 'site_shipping',
                'value' => '0',
            ],
            [
                'key' => 'site_return',
                'value' => '0',
            ],
            [
                'key' => 'site_refund',
                'value' => '0',
            ],
            [
                'key' => 'site_terms',
                'value' => '0',
            ],
            [
                'key' => 'site_privacy',
                'value' => '0',
            ],
            [
                'key' => 'site_about',
                'value' => '0',
            ],
            [
                'key' => 'site_contact',
                'value' => '0',
            ],

       ] );
    }
}