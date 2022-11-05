<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Subcategory;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Str; 
class ProductImport implements ToModel
{
    // $image = file_get_contents($url);
    // $name = Str::random(10) . '.jpg';
    // $path = local_files('products/' . $name);
    // file_put_contents($path, $image);
    // return $name;

     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[0],
            'description' => $row[1],
            'price' => $row[2],
            'old_price' => $row[3] ?? null,
            'slug' => Str::slug($row[0]),
            'code' => Str::random(10),
            'category_id' => Category::where('name', $row[4])->first()->id,
            'subcategory_id' => Subcategory::where('name', $row[5])->first()->id ?? null,
            'brand_id' => Brand::where('name', $row[5])->first()->id ?? null,
            
            'image' => Product::getImageFromUrl($row[6]),

            // 'gallery' => getGalleryFromUrl($row[7]) ?? null,
            'meta_title' => Str::limit($row[0], 60),
            'meta_description' => Str::limit($row[1], 160),
            'meta_keywords' => Str::limit($row[0], 60),
        ]);
    }
    
}