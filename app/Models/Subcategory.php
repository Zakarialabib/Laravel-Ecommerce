<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'category_id', 'name', 'slug', 'language_id',
    ];

    public $timestamps = false;

    protected $fillable = [
        'category_id', 'name', 'slug', 'language_id',
    ];

    protected $filterable = [
        'id', 'category_id', 'name', 'slug', 'language_id',
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }
}
