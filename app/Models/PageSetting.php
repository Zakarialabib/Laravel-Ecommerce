<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class PageSetting extends Model
{
    use HasAdvancedFilter;

    public $table = 'pagesettings';

    public $orderable = [
       'id', 'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand', // bool
        'status',
        'featured_banner_id',
        'page_id',
        'language_id',
    ];
    public $filterable = [
       'id', 'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand', // bool
        'status',
        'featured_banner_id',
        'page_id',
        'language_id',
    ];
    protected $fillable = [
        'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand', // bool
        'status',
        'featured_banner_id',
        'page_id',
        'language_id',
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
