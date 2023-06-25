<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shipping extends Model
{
    use HasAdvancedFilter;
    use SoftDeletes;

    public $orderable = [
        'id', 'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];

    protected $filterable = [
        'id', 'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];

    protected $fillable = [
        'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];
}
