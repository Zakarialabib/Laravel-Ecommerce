<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Slider extends Model
{
    use HasAdvancedFilter;

    protected $orderable = [
        'id','title','subtitle','details','photo','position','link','language_id','bg_color'
    ];

    public $filtrable = [
         'id','title','subtitle','details','photo','position','link','language_id','bg_color'
    ];

    protected $fillable = [
       'title','subtitle','details','photo','position','link','language_id','bg_color'
    ];
    
    public $timestamps = false;

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }  

}
