<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\HasAdvancedFilter;

class Product extends Model
{
    use HasAdvancedFilter;

    protected $ordrable = [
        'id','name','slug','details','price','photo','status','created_at','updated_at'
    ];

    protected $filterable = [
        'id','name','slug','details','price','photo','status','created_at','updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'gallery',
        'category_id',
        'brand_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    // get name set slug with Str::
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

  
}
