<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Faq extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id','title', 'details','language_id'
    ];
    public $orderable = [
        'id','title', 'details','language_id'
    ];

    protected $fillable = [
        'title', 'details','language_id'
    ];
    public $timestamps = false;

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }  

}
