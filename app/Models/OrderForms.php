<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

Class OrderForms extends Model
{
    use HasAdvancedFilter;

    public $table = 'orderforms';

    const HOME_FORM    = 1;
    const PRODUCT_FORM    = 2;

    const STATUS_PENDING    = 1;
    const STATUS_APPROVED   = 2;
    const STATUS_REJECTED   = 3;

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
