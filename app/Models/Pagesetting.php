<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagesetting extends Model
{
    public $table = 'pagesettings';

    protected $fillable = [
        'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand',
        'component', 'status', 'featured_banner_id', 'page_id', 'language_id',
    ];

    public function featuredBanner()
    {
        return $this->belongsTo(FeaturedBanner::class, 'featured_banner_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
