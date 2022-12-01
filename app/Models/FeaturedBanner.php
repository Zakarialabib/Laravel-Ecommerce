<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class FeaturedBanner extends Model
{
    use HasAdvancedFilter;

    const StatusInactive = 0;

    const StatusActive = 1;

    public $orderable = [
        'id', 'title', 'details', 'image', 'status', 'featured', 'language_id',
    ];

    protected $filterable = [
        'id', 'title', 'details', 'image', 'status', 'featured', 'language_id',
    ];

    protected $fillable = [
        'title', 'details', 'image','embeded_video', 'status', 'featured', 'link', 'language_id', 'product_id',
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
