<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasAdvancedFilter;

    public const StatusInActive = 0;

    public const StatusActive = 1;

    public $orderable = [
        'id', 'name', 'status', 'image',
    ];

    public $filterable = [
        'id', 'name', 'status', 'image',
    ];

    protected $fillable = [
        'name',
        'status',
        'image',
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

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
