<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'width',
        'frequency',
        'timing',
        'delay',
        'duration',
        'backgroundColor',
        'content',
        'ctaText',
        'ctaUrl',
        'status',
        'is_default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'delay' => 'integer',
        'duration' => 'integer',
        'visits' => 'integer',
        'is_default' => 'boolean',
    ];

    public function scopeDefault($query): Builder
    {
        return $query->where('is_default', true)->first();
    }
}
