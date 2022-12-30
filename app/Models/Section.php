<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasAdvancedFilter;

    public $table = 'sections';

    public const HOME_PAGE = 1;

    public const ABOUT_PAGE = 2;

    public const BRAND_PAGE = 3;

    public const BLOG_PAGE = 4;

    public const CATALOG_PAGE = 5;

    public const BRANDS_PAGE = 6;

    public const CONTACT_PAGE = 7;

    public const PRODUCT_PAGE = 8;

    public const PRIVACY_PAGE = 9;

    public $orderable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    public $filterable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    protected $fillable = [
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }
}
