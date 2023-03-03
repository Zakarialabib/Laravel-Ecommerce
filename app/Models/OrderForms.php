<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class OrderForms extends Model
{
    use HasAdvancedFilter;

    public const HOME_FORM = 1;

    public const PRODUCT_FORM = 2;

    public const STATUS_PENDING = 1;

    public const STATUS_APPROVED = 2;

    public const STATUS_REJECTED = 3;

    public $table = 'orderforms';

    public $orderable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    public $filterable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'type',
        'status',
        'subject',
        'message',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
