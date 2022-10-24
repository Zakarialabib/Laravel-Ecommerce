<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'id'           => 1,
            'name'        => 'Dirham',
            'sign' => 'DH',
            'value'      => 1,
            'is_default'      => 1,
            ],
            
        ]);
    }    
    }