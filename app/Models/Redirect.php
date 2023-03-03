<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id',
        'old_url',
        'new_url',
        'status',
        'created_at',
        'updated_at',
    ];
    public $filterable = [
        'id',
        'old_url',
        'new_url',
        'status',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'old_url',
        'new_url',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];
}
