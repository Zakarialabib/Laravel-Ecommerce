<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

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
                'id'             => 1,
                'title'          => 'Welcome to BADR LUXURY',
                'image'          => 'image.jpg',
                'featured_title' => 'BADR LUXURY',
                'subtitle'       => 'BADR LUXURY',
                'label'          => 'BADR LUXURY',
                'link'           => 'https://badrluxury.com/',
                'description'    => 'BADR LUXURY',
                'status'         => '1',
                'bg_color'       => 'bg-green-500',
                'page'           => 'home',
                'position'       => '1',
                'language_id'    => '1',
            ],
        ]);
    }
}
