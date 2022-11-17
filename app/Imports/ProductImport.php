<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Subcategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str; 
use Helpers;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ProductImport implements ToModel , WithHeadingRow
{
        /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
            return new Product([
            'name' => $row['nom'],
            'description' => $row['description'],
            'price' => $row['prix'],
            'old_price' => $row['ancien_prix'] ?? null,
            'slug' => Str::slug($row['nom'], '-') . '-' . Str::random(5),
            'code' => Str::random(10),
            'category_id' => Category::where('name', $row['categorie'])->first()->id ?? Category::create(['name' => $row['categorie']])->id ?? null,
            'subcategory_id' => Subcategory::where('name', $row['sous_categorie'])->first()->id ?? Helpers::createSubcategory($row['sous_categorie'], $row['categorie']) ?? null,
            'brand_id' => Brand::where('name', $row['marque'])->first()->id ?? Brand::create(['name' => $row['marque']])->id ?? null,
            'image' => Helpers::uploadImage($row['image']) ?? 'default.jpg',
            // 'gallery' => getGalleryFromUrl($row[7]) ?? null,
            'meta_title' => Str::limit($row['nom'], 60),
            'meta_description' => Str::limit($row['description'], 160),
            'meta_keywords' => Str::limit($row['nom'], 60),
            'status' => 0,
            ]); 
    }
    
}