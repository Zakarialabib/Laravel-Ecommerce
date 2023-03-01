<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUpdates implements ToModel
{
    public function model(array $row)
    {
        $product = Product::where('code', $row[0])->first();

        if (! $product) {
            return null;
        }

        $product->code = $row[0];
        $product->price = $row[1];

        if (isset($row[2])) {
            $product->old_price = $row[2];
        }

        $product->save();

        return null;
    }
}
