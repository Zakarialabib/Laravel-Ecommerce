<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Currency,
    Models\Shipping
};
use Illuminate\Http\Request;
use Validator;
use Datatables;

class ShippingController extends AdminBaseController
{
    //*** JSON Request
    public function datatables()
    {
         $datas = Shipping::all();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('price', function(Shipping $data) {
                                $price = $data->price * $this->curr->value;
                                return \PriceHelper::showAdminCurrencyPrice($price);
                            })
                            ->addColumn('action', function(Shipping $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-shipping-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a><a href="javascript:;" data-href="' . route('admin-shipping-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.shipping.index');
    }

    //*** GET Request
    public function create()
    {
        $sign = $this->curr;
        return view('admin.shipping.create',compact('sign'));
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = ['title' => 'unique:shippings'];
        $customs = ['title.unique' => __('This title has already been taken.')];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $sign = $this->curr;
        $data = new Shipping();
        $input = $request->all();
        $input['price'] = ($input['price'] / $sign->value);
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = __('New Data Added Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id)
    {
        $sign = $this->curr;
        $data = Shipping::findOrFail($id);
        return view('admin.shipping.edit',compact('data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = ['title' => 'unique:shippings,title,'.$id];
        $customs = ['title.unique' => __('This title has already been taken.')];
        $validator = Validator::make($request->all(), $rules, $customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }        
        //--- Validation Section Ends

        //--- Logic Section
        $sign = $this->curr;
        $data = Shipping::findOrFail($id);
        $input = $request->all();
        $input['price'] = ($input['price'] / $sign->value);
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Shipping::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
}
