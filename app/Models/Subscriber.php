<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'email', 'id',
    ];

    public $orderable = [
        'email', 'id',
    ];

    protected $fillable = ['email'];

    public $timestamps = false;
}
