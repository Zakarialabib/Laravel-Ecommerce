<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\HasAdvancedFilter;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\CanBeBought;

class Product extends Model implements Buyable 
{
    use CanBeBought;
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
    
    public function getDiscountAttribute()
    {
        if ($this->old_price) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return null;
    }
    // get image from url and save to uploads/products
    public function getImageFromUrl($url)
    {
        $image = file_get_contents($url);
        $name = Str::random(10) . '.jpg';
        $path = local_files('products/' . $name);
        file_put_contents($path, $image);
        return $name;
    }
    
    // get gallery from url and save to uploads/products
    public function getGalleryFromUrl($url)
    {
        $gallery = explode(',', $url);
        $gallery = array_map(function ($item) {
            return $this->getImageFromUrl($item);
        }, $gallery);
        return implode(',', $gallery);
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class , 'brand_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class , 'subcategory_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
