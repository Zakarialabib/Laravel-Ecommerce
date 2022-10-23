<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Shipping extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id','user_id', 'title', 'subtitle', 'price','language_id'
    ];

    public $orderable = [
    'id','user_id', 'title', 'subtitle', 'price','language_id'
    ];
    protected $fillable = ['user_id', 'title', 'subtitle', 'price','language_id'];

    public $timestamps = false;

    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }  

}