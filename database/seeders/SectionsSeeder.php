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
                'title'          => 'Welcome to APPECOM',
                'image'          => 'image.jpg',
                'featured_title' => 'APPECOM',
                'subtitle'       => 'APPECOM',
                'label'          => 'APPECOM',
                'link'           => 'https://badrluxury.com/',
                'description'    => 'APPECOM',
                'status'         => '1',
                'bg_color'       => 'bg-green-500',
                'page'           => 'home',
                'position'       => '1',
                'language_id'    => '1',
            ],
        ]);
    }
}
