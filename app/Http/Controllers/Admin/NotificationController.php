<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use DB;

class NotificationController extends AdminBaseController
{
  public function all_notf_count()
  {
      $user_count = DB::table('notifications')->where('user_id','!=',null)->where('is_read','=',0)->count();
      $order_count = DB::table('notifications')->where('order_id','!=',null)->where('is_read','=',0)->count();
      $product_count = DB::table('notifications')->where('product_id','!=',null)->where('is_read','=',0)->count();
      $conv_count = DB::table('notifications')->where('conversation_id','!=',null)->where('is_read','=',0)->count();

      $data = array();        
      $data['user_count'] = $user_count;
      $data['conv_count'] = $conv_count;
      $data['order_count'] = $order_count;
      $data['product_count'] = $product_count;

      return response()->json($data);            
  } 

  public function user_notf_clear()
  {
      $data = Notification::where('user_id','!=',null);
      $data->delete();        
  } 

  public function user_notf_show()
  {
      $datas = Notification::where('user_id','!=',null)->latest('id')->get();
      if($datas->count() > 0){
        foreach($datas as $data){
          $data->is_read = 1;
          $data->update();
        }
      }       
      return view('admin.notification.register',compact('datas'));           
  } 

  public function order_notf_clear()
  {
      $data = Notification::where('order_id','!=',null);
      $data->delete();        
  } 

  public function order_notf_show()
  {
      $datas = Notification::where('order_id','!=',null)->latest('id')->get();
      if($datas->count() > 0){
        foreach($datas as $data){
          $data->is_read = 1;
          $data->update();
        }
      }       
      return view('admin.notification.order',compact('datas'));           
  } 

  public function product_notf_clear()
  {
      $data = Notification::where('product_id','!=',null);
      $data->delete();        
  } 

  public function product_notf_show()
  {
      $datas = Notification::where('product_id','!=',null)->latest('id')->get();
      if($datas->count() > 0){
        foreach($datas as $data){
          $data->is_read = 1;
          $data->update();
        }
      }       
      return view('admin.notification.product',compact('datas'));           
  } 

  public function conv_notf_clear()
  {
      $data = Notification::where('conversation_id','!=',null);
      $data->delete();        
  } 

  public function conv_notf_show()
  {
      $datas = Notification::where('conversation_id','!=',null)->latest('id')->get();
      if($datas->count() > 0){
        foreach($datas as $data){
          $data->is_read = 1;
          $data->update();
        }
      }       
      return view('admin.notification.message',compact('datas'));           
  } 

}