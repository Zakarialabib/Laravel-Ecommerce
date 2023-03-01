<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'subtitle', 'cost'];
}
