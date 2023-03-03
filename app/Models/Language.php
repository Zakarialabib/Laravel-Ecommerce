<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 0;

    public const IS_DEFAULT = 1;

    public const IS_NOT_DEFAULT = 0;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
    ];

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog', 'language_id');
    }

    public function blog_categories()
    {
        return $this->hasMany('App\Models\BlogCategory', 'language_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'language_id');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Models\Subcategory', 'language_id');
    }

    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'language_id');
    }

    public function shippings()
    {
        return $this->hasMany('App\Models\Shipping', 'language_id');
    }

    public function sliders()
    {
        return $this->hasMany('App\Models\Slider', 'language_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'language_id');
    }
}
