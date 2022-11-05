<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id' , 'name','code','status','image',
    ];

    public $filterable = [
        'id' , 'name','code','status','image'
    ];

    protected $fillable = [
        'name',
        'code',
        'status',
        'image'
    ];


    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function subcategories() {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }
}
