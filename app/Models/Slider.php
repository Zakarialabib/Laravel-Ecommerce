<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasAdvancedFilter;

    public const StatusInactive = 0;

    public const StatusActive = 1;

    public $table = 'sliders';

    public $orderable = [
        'id', 'title', 'subtitle', 'featured', 'link', 'language_id',
    ];

    public $filterable = [
        'id', 'title', 'subtitle', 'featured', 'link', 'language_id',
    ];

    public $timestamps = false;

    protected $fillable = [
        'title', 'subtitle', 'details', 'embeded_video', 'photo', 'featured', 'link', 'language_id', 'bg_color', 'status',
    ];

    /**
     * Scope a query to only include active products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
