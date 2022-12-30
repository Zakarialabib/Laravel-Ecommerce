<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            [
                'id'         => 1,
                'name'       => 'Dirham',
                'symbol'     => 'DH',
                'position'   => 'right',
                'value'      => 1,
                'is_default' => 1,
            ],

        ]);
    }
}
