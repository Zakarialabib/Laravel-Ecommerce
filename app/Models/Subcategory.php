<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasAdvancedFilter;

    protected $fillable = [
        'category_id', 'name', 'slug', 'language_id',
    ];

    protected $filterable = [
        'id', 'category_id', 'name', 'slug', 'language_id',
    ];

    public $orderable = [
        'id', 'category_id', 'name', 'slug', 'language_id',
    ];

    public $timestamps = false;


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
