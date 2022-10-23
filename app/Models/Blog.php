<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Blog extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id','title','slug','category_id', 'details', 'photo', 'source', 'views','updated_at', 'status','meta_tag','meta_description','tags','language_id' 
    ];
    
    public $orderable = [
        'id','title','slug','category_id', 'details', 'photo', 'source', 'views','updated_at', 'status','meta_tag','meta_description','tags','language_id' 
    ];

    protected $fillable = [
        'title','slug','category_id', 'details', 'photo', 'source', 'views','updated_at', 'status','meta_tag','meta_description','tags','language_id'
    ];

    protected $dates = ['created_at'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\BlogCategory','category_id')->withDefault();
    }

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }

}
