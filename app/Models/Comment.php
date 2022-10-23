<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Comment extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id','product_id', 'user_id','text'
    ];

    public $orderable = [
        'id','product_id', 'user_id','text'
    ];

    protected $fillable = ['product_id', 'user_id','text'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function product()
    {
    	return $this->belongsTo('App\Models\Product')->withDefault();
    }

	public function replies()
	{
	     return $this->hasMany('App\Models\Reply');
	}

}
