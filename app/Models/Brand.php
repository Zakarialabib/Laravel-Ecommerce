<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'name', 'description', 'image', 'slug', 'status', 'featured_image', 'meta_title', 'meta_description',
    ];

    protected $filterable = [
        'id', 'name', 'description', 'image', 'slug', 'status', 'featured_image', 'meta_title', 'meta_description',
    ];

    protected $fillable = [
        'name', 'description', 'image', 'slug', 'status', 'featured_image', 'meta_title', 'meta_description',
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

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
