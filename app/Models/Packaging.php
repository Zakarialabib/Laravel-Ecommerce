<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $fillable = ['title', 'subtitle', 'cost'];

    public $timestamps = false;

}