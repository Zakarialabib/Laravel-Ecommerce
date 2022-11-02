<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\HasAdvancedFilter;

class Product extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id',
         'name',
        'description',
        'price',
        'code',
        'category_id',
        'brand_id',
        'status',
    ];

    public $filterable = [
        'id',
        'name',
       'description',
       'price',
       'code',
       'category_id',
       'brand_id',
       'status',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'slug',
        'code',
        'image',
        'gallery',
        'category_id',
        'subcategory_id',
        'brand_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'hot',
        'best',
        'top',
        'latest',
        'big',
        'trending',
        'sale',
        'is_discount',
        'discount_date',
    ];

    // get name set slug with Str::
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class , 'brand_id', 'id');
    }

  
}
