<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Support\HasAdvancedFilter;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Gloudemans\Shoppingcart\CanBeBought;

class Product extends Model implements Buyable 
{
    use CanBeBought, HasAdvancedFilter;

    const StatusInActive = 0;
    const StatusActive = 1;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

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
