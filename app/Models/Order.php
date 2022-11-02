<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasAdvancedFilter;
    
    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_REFUNDED = 5;

    const PAYMENT_STATUS_PENDING = 1;
    const PAYMENT_STATUS_PROCESSING = 2;
    const PAYMENT_STATUS_COMPLETED = 3;
    const PAYMENT_STATUS_CANCELLED = 4;
    const PAYMENT_STATUS_REFUNDED = 5;

	protected $fillable = [
        'user_id','reference','status','currency_id', 'shipping_id',
        'cart', 'delivery_method','payment_method','totalQty','payment_status',
        'packaging_id','order_note','products','total','subtotal','tax',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip','shipping_state','shipping_country',
    ];

    public $orderable = [
        'id','user_id','reference','status','currency_id', 'shipping_id',
        'cart', 'delivery_method','payment_method','totalQty','payment_status',
        'packaging_id','order_note','products','total','subtotal','tax',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip','shipping_state','shipping_country',
    ];    
    protected $filterable = [
        'id','user_id','reference','status','currency_id', 'shipping_id',
        'cart', 'delivery_method','payment_method','totalQty','payment_status',
        'packaging_id','order_note','products','total','subtotal','tax',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip','shipping_state','shipping_country',
    ];

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes(array(
            'reference' => 'SL-' . Carbon::now()->format('Ymd') . '-' . Str::random(4)
        ), true);
        parent::__construct($attributes);
    }

    public static function generateReference()
    {
        $lastOrder = self::latest()->first();
        if ($lastOrder) {
            $number = substr($lastOrder->reference, -6) + 1;
        } else {
            $number = 1;
        }
        return date('Ymd') . '-' . sprintf('%06d', $number);
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification','order_id');
    }

    public function tracks()
    {
        return $this->hasMany('App\Models\OrderTrack','order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public function packaging()
    {
        return $this->belongsTo(Packaging::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('qty', 'price', 'tax', 'total');
    }


}
