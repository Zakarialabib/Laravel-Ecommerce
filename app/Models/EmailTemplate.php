<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class EmailTemplate extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'type',
        'subject',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id', 
        'name',
        'description',
        'message',
        'default',
        'placeholders',
        'type',
        'subject',
        'status',
    ];

    public function scopeDefault(Builder $query)
    {
        return $query->where('default', true);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }

}
