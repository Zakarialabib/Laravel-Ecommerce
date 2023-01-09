<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Shipping::insert([
            [
                'id'        => 1,
                'is_pickup' => true,
                'title'     => 'local',
                'subtitle'  => 'same city',
                'cost'      => '0',
            ],
        ]);
    }
}
