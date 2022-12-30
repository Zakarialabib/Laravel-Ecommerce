<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Slider::insert([
            [
                'subtitle' => 'Slider Subtitle',
                'title'    => 'Slider Title',
                'details'  => 'Slider Details',
                'photo'    => 'slider.jpg',
                'bg_color' => 'bg-white',
                'featured' => 1,
                'link'     => 'https://www.google.com',
            ],
            [
                'subtitle' => 'Slider Subtitle',
                'title'    => 'Slider Title',
                'details'  => 'Slider Details',
                'photo'    => 'slider.jpg',
                'bg_color' => 'bg-white',
                'featured' => 0,
                'link'     => 'https://www.google.com',
            ],
            [
                'subtitle' => 'Slider Subtitle',
                'title'    => 'Slider Title',
                'details'  => 'Slider Details',
                'photo'    => 'slider.jpg',
                'bg_color' => 'bg-white',
                'featured' => 0,
                'link'     => 'https://www.google.com',
            ],
        ]);
    }
}
