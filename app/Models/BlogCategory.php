<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class BlogCategory extends Model
{
    use HasAdvancedFilter;
    
    protected $fillable = ['name','status', 'slug','language_id'];

    protected $filterable = [
        'id','name','slug','language_id'
    ];

    public $orderable = [
        'id','name','slug','language_id'
    ];

    public $timestamps = false;

    public function blogs()
    {
    	return $this->hasMany('App\Models\Blog','category_id');
    }

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }  

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = str_replace(' ', '-', $value);
    }
}
