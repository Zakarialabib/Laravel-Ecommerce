<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Slider extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id','subtitle_text','subtitle_size','subtitle_color','subtitle_anime','title_text','title_size','title_color','title_anime','details_text','details_size','details_color','details_anime','photo','position','link','language_id'
    ];

    public $orderable = [
    'id','subtitle_text','subtitle_size','subtitle_color','subtitle_anime','title_text','title_size','title_color','title_anime','details_text','details_size','details_color','details_anime','photo','position','link','language_id'
    ];

    protected $fillable = [
        'subtitle_text','subtitle_size','subtitle_color','subtitle_anime','title_text','title_size','title_color','title_anime','details_text','details_size','details_color','details_anime','photo','position','link','language_id'
    ];
    
    public $timestamps = false;

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }  

}
