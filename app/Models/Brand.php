<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

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

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
