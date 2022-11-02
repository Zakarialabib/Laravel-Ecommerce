<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id' , 'name','description','status','image',
    ];

    public $filterable = [
        'id' , 'name','description','status','image'
    ];

    protected $fillable = [
        'name',
        'description',
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
