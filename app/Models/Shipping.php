<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Shipping extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id','is_pickup', 'title', 'subtitle', 'cost','language_id','status'
    ];

    public $orderable = [
        'id','is_pickup', 'title', 'subtitle', 'cost','language_id','status'
    ];
    protected $fillable = [ 
        'is_pickup', 'title', 'subtitle', 'cost','language_id','status'
    ];

    public $timestamps = false;


}