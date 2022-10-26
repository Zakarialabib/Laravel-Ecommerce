<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Category extends Model
{
    use HasAdvancedFilter, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image'
    ];
}
