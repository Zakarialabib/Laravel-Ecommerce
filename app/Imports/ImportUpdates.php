<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Helpers;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUpdates implements ToModel
{
    public function model(array $row)
    {
        $product = Product::where('name', $row[0])->first();

        if ($product === null) {
            $product = Product::create([
                'name'          => $row[0],
                'description'   => $row[2],
                'price'         => $row[4],
                'old_price'     => $row[5] ?? null,
                'slug'          => Str::slug($row[0], '-').'-'.Str::random(5),
                'code'          => Str::random(10),
                'category_id'   => Category::where('name', $row[6])->first()->id ?? Helpers::createCategory(['name' => $row[6]])->id ?? null,
                'subcategories' => !empty($row[7]) ? Subcategory::whereIn('name', explode(',', $row[7]))->pluck('id')->toArray() : [],
                'brand_id'      => Brand::where('name', $row[8])->first()->id ?? Helpers::createBrand(['name' => $row[8]]),
                'image'         => Helpers::uploadImage($row[1], $row[0]) ?? 'default.jpg',
                // 'gallery' => getGalleryFromUrl($row[7]) ?? null,
                'meta_title'       => Str::limit($row[0], 60),
                'meta_description' => Str::limit($row[2], 160),
                'meta_keywords'    => Str::limit($row[0], 60),
                'status'           => 0,
            ]);

            return null;
        }

        // $product->code = $row['code'];
        $product->price = $row[4];
        $product->old_price = $row[5] ?? null;
        $product->save();

        return null;
    }
}
