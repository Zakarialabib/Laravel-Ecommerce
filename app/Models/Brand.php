<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Brand extends Model
{
    use HasAdvancedFilter, HasFactory;

    protected $fillable = [
        'name',
        'link',
        'image',
        'status',
    ];
}
