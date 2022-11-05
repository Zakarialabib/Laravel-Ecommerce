<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Slider extends Model
{
    use HasAdvancedFilter;

    public $table = 'sliders';

    public $orderable = [
        'id','title','subtitle','position','link','language_id'
    ];

    public $filterable = [
         'id','title','subtitle','position','link','language_id'
    ];

    protected $fillable = [
       'title','subtitle','details','photo','position','link','language_id','bg_color','status'
    ];
    
    public $timestamps = false;

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }  

}
