<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model implements Buyable
{
    use CanBeBought;
    use HasAdvancedFilter;

    public const StatusInActive = 0;

    public const StatusActive = 1;

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
        'embeded_video',
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

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Product model
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')->withPivot('qty', 'price', 'tax', 'total');
    }
}
