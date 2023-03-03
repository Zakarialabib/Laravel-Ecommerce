<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['order_id', 'user_id', 'product_id'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product')->withDefault();
    }

    public static function countRegistration()
    {
        return Notification::where('user_id', '!=', null)->where('is_read', '=', 0)->latest('id')->get()->count();
    }

    public static function countOrder()
    {
        return Notification::where('order_id', '!=', null)->where('is_read', '=', 0)->latest('id')->get()->count();
    }

    public static function countProduct()
    {
        return Notification::where('product_id', '!=', null)->where('is_read', '=', 0)->latest('id')->get()->count();
    }
}
