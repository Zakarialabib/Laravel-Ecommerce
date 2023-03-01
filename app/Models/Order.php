<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasAdvancedFilter;

    public const STATUS_PENDING = 1;

    public const STATUS_PROCESSING = 2;

    public const STATUS_COMPLETED = 3;

    public const STATUS_CANCELLED = 4;

    public const STATUS_REFUNDED = 5;

    public const PAYMENT_STATUS_PENDING = 1;

    public const PAYMENT_STATUS_PROCESSING = 2;

    public const PAYMENT_STATUS_COMPLETED = 3;

    public const PAYMENT_STATUS_CANCELLED = 4;

    public const PAYMENT_STATUS_REFUNDED = 5;

    public $orderable = [
        'id', 'user_id', 'reference', 'status', 'currency_id', 'shipping_id',
        'cart', 'delivery_method', 'payment_method', 'totalQty', 'payment_status',
        'packaging_id', 'order_note', 'products', 'total', 'subtotal', 'tax',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip', 'shipping_state', 'shipping_country',
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'user_id', 'reference', 'status', 'currency_id', 'shipping_id',
        'cart', 'delivery_method', 'payment_method', 'totalQty', 'payment_status',
        'packaging_id', 'order_note', 'products', 'total', 'subtotal', 'tax',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip', 'shipping_state', 'shipping_country',
        'created_at', 'updated_at',
    ];

    protected $filterable = [
        'id', 'user_id', 'reference', 'status', 'currency_id', 'shipping_id',
        'cart', 'delivery_method', 'payment_method', 'totalQty', 'payment_status',
        'packaging_id', 'order_note', 'products', 'total', 'subtotal', 'tax',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip', 'shipping_state', 'shipping_country',
        'created_at', 'updated_at',
    ];

    public static function generateReference()
    {
        $lastOrder = self::latest()->first();

        if ($lastOrder) {
            $number = substr($lastOrder->reference, -6) + 1;
        } else {
            $number = 1;
        }

        return date('Ymd').'-'.sprintf('%06d', $number);
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'order_id');
    }

    public function tracks()
    {
        return $this->hasMany('App\Models\OrderTrack', 'order_id');
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
