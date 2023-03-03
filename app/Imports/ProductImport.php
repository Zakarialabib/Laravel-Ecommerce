<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::create([
                'name' => $row['nom'],
                'description' => $row['description'],
                'price' => $row['prix'],
                'old_price' => $row['ancien_prix'] ?? null,
                'slug' => Str::slug($row['nom'], '-').'-'.Str::random(5),
                'code' => Str::random(10),
                'category_id' => Category::where('name', $row['categorie'])->first()->id ?? Category::create(['name' => $row['categorie']])->id ?? null,
                'subcategory_id' => Subcategory::where('name', $row['sous_categorie'])->first()->id ?? Helpers::createSubcategory($row['sous_categorie'], $row['categorie']),
                'brand_id' => Brand::where('name', $row['marque'])->first()->id ?? Helpers::createBrand(['name' => $row['marque']]),
                'image' => Helpers::uploadImage($row['image']) ?? 'default.jpg',
                // 'gallery' => getGalleryFromUrl($row[7]) ?? null,
                'meta_title' => Str::limit($row['nom'], 60),
                'meta_description' => Str::limit($row['description'], 160),
                'meta_keywords' => Str::limit($row['nom'], 60),
                'status' => 0,
            ]);
        }
    }
}
