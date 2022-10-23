<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Order extends Model
{
    use HasAdvancedFilter;
    
	protected $fillable = [
        'user_id', 'cart', 'method','shipping', 'pickup_location', 'totalQty',
        'pay_amount', 'txnid', 'charge_id', 'order_number', 'payment_status',
        'customer_name','customer_lastname', 'customer_email', 'customer_phone', 'customer_address',
        'customer_city', 'customer_zip','customer_state', 'customer_country',
        'shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address',
        'shipping_city', 'shipping_zip','shipping_state','shipping_country',
        'order_note','coupon_code','coupon_discount','status','affilate_user',
        'affilate_charge','currency_sign','currency_name','currency_value',
        'shipping_cost','packing_cost','tax','tax_location','dp','pay_id',
        'vendor_shipping_id','vendor_packing_id','wallet_price','shipping_title',
        'packing_title','affilate_users','commission'
    ];

    public $orderable = [
    'id','user_id', 'cart', 'method','shipping', 'pickup_location', 
    'totalQty', 'pay_amount', 'txnid', 'charge_id', 'order_number', 
    'payment_status', 'customer_name', 'customer_email', 'customer_phone', 
    'customer_address', 'customer_city', 'customer_zip','customer_state',
    'customer_country','shipping_name', 'shipping_email', 'shipping_phone',
    'shipping_address', 'shipping_city', 'shipping_zip','shipping_state',
    'shipping_country', 'order_note','coupon_code','coupon_discount',
    'status','currency_sign','tax','tax_location','shipping_title','packing_title',
      'currency_name','currency_value','shipping_cost','packing_cost',
    ];    
    protected $filterable = [
        'id','user_id', 'cart', 'method','shipping', 'pickup_location', 
        'totalQty', 'pay_amount', 'txnid', 'charge_id', 'order_number', 
        'payment_status', 'customer_name', 'customer_email', 'customer_phone', 
        'customer_address', 'customer_city', 'customer_zip','customer_state',
        'customer_country','shipping_name', 'shipping_email', 'shipping_phone',
        'shipping_address', 'shipping_city', 'shipping_zip','shipping_state',
        'shipping_country', 'order_note','coupon_code','coupon_discount',
        'status','currency_sign','tax','tax_location','shipping_title','packing_title',
          'currency_name','currency_value','shipping_cost','packing_cost',
    ];

    public function vendororders()
    {
        return $this->hasMany('App\Models\VendorOrder','order_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification','order_id');
    }

    public function tracks()
    {
        return $this->hasMany('App\Models\OrderTrack','order_id');
    }

    public static function getShipData($cart,$language_id)
    {
        $vendor_shipping_id = 0;
        $user = array();
        foreach ($cart->items as $prod) {
                $user[] = $prod['item']['user_id'];
        }
        $users = array_unique($user);
        if(count($users) == 1)
        {
            $shipping_data  = DB::table('shippings')->whereLanguageId($language_id)->whereUserId($users[0])->get();
            if(count($shipping_data) == 0){
                $shipping_data  = DB::table('shippings')->whereLanguageId($language_id)->whereUserId(0)->get();
            }
            else{
                $vendor_shipping_id = $users[0];
            }
        }
        else {
            $shipping_data  = DB::table('shippings')->whereLanguageId($language_id)->whereUserId(0)->get();
        }
        $data['shipping_data'] = $shipping_data;
        $data['vendor_shipping_id'] = $vendor_shipping_id;
        return $data; 
    }

    public static function getPackingData($cart,$language_id)
    {
        $vendor_packing_id = 0;
        $user = array();
        foreach ($cart->items as $prod) {
                $user[] = $prod['item']['user_id'];
        }
        $users = array_unique($user);
        if(count($users) == 1)
        {
            $package_data  = DB::table('packages')->whereLanguageId($language_id)->whereUserId($users[0])->get();

            if(count($package_data) == 0){
                $package_data  = DB::table('packages')->whereLanguageId($language_id)->whereUserId(0)->get();
            }
            else{
                $vendor_packing_id = $users[0];
            }  
        }
        else {
            $package_data  = DB::table('packages')->whereLanguageId($language_id)->whereUserId(0)->get();
        }
        $data['package_data'] = $package_data;
        $data['vendor_packing_id'] = $vendor_packing_id;
        return $data; 
    }
}
