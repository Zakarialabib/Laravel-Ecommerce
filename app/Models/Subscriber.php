<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Subscriber extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'email','id'
    ];
    public $orderable = [
        'email','id'
    ];

    protected $fillable = ['email'];
    
    public $timestamps = false;

}
