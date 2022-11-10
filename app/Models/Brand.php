<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Brand extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
       'id', 'name', 'description', 'image','link','status',
    ];

    public $filterable = [
        'id', 'name', 'description', 'image','link','status',
    ];

    protected $fillable = [
        'name', 'description', 'image','link','status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

   
}
