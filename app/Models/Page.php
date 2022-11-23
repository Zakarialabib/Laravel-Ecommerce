<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id', 'title', 'slug', 'details', 'meta_title', 'meta_description', 'language_id', 'photo',
    ];

    public $orderable = [
        'id', 'title', 'slug', 'details', 'meta_title', 'meta_description', 'language_id', 'photo',
    ];

    protected $fillable = [
        'title', 'slug', 'details', 'meta_title', 'meta_description', 'language_id', 'photo',
    ];

    public $timestamps = false;

    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id')->withDefault();
    }
}
