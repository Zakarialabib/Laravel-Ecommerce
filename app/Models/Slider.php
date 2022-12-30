<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasAdvancedFilter;

    public $table = 'sliders';

    public const StatusInactive = 0;

    public const StatusActive = 1;

    public $orderable = [
        'id', 'title', 'subtitle', 'featured', 'link', 'language_id',
    ];

    public $filterable = [
        'id', 'title', 'subtitle', 'featured', 'link', 'language_id',
    ];

    protected $fillable = [
        'title', 'subtitle', 'details', 'embeded_video', 'photo', 'featured', 'link', 'language_id', 'bg_color', 'status',
    ];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
