<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasAdvancedFilter;

    protected $fillable = [
        'title',
        'description',
        'meta_tag',
        'meta_description',
        'featured',
        'language_id',
    ];

    protected $filterable = [
        'id',
        'title',
        'description',
        'meta_tag',
        'meta_description',
        'featured',
        'language_id',
    ];

    public $orderable = [
        'id',
        'title',
        'description',
        'meta_tag',
        'meta_description',
        'featured',
        'language_id',
    ];

    public $timestamps = false;

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog', 'category_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id')->withDefault();
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $value);
    }
}
