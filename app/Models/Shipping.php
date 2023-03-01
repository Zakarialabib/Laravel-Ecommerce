<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];

    public $timestamps = false;

    protected $filterable = [
        'id', 'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];

    protected $fillable = [
        'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];
}
