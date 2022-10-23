<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['photo','title','subtitle','details'];
    public $timestamps = false;
}
