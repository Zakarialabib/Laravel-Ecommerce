<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsSeeder extends Seeder
{
 /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Section::insert([
            [
            'id' => 1,
            'title' => 'Welcome to BADR LUXURY',
            'image' => 'image.jpg',
            'featured_title' => 'BADR LUXURY',
            'subtitle' => 'BADR LUXURY',
            'label' => 'BADR LUXURY',
            'link' => 'https://badrluxury.com/',
            'description' => 'BADR LUXURY',
            'status' => '1',
            'bg_color' => 'bg-green-500',
            'page' => 'home',
            'position' => '1',
            'language_id' => '1',
        ]
        ]);
    }
}
