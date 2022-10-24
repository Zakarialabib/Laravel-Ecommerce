<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Section extends Model
{
    use HasAdvancedFilter;

    public $table = 'sections';
 
    const HOME_PAGE    = 1;
    const ABOUT_PAGE    = 2;
    const PARTNERS_PAGE    = 3;
    const BLOG_PAGE = 4;
    const SERVICE_PAGE  = 5;
    const BRANDS_PAGE  = 6;
    const CONTACT_PAGE  = 7;
    const PRODUCT_PAGE  = 8;
    const PRIVACY_PAGE    = 9;

    public $orderable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'featured_title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id'
    ];

    public $filterable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'featured_title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id'
    ];

    protected $fillable = [        
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'featured_title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id'
    ];

    
    public function language() {
        return $this->belongsTo('App\Models\Language');
    }
}
