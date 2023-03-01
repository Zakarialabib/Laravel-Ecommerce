<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Validator;

class CurrencyController extends Controller
{
    public function index()
    {
        return view('admin.currency.index');
    }

    public function create()
    {
        return view('admin.currency.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = ['name' => 'unique:currencies', 'sign' => 'unique:currencies'];
        $customs = ['name.unique' => __('This name has already been taken.'), 'sign.unique' => __('This sign has already been taken.')];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Currency();
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New Data Added Successfully.');

        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function edit($id)
    {
        $data = Currency::findOrFail($id);

        return view('admin.currency.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = ['name' => 'unique:currencies,name,'.$id, 'sign' => 'unique:currencies,sign,'.$id];
        $customs = ['name.unique' => __('This name has already been taken.'), 'sign.unique' => __('This sign has already been taken.')];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Currency::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends
        cache()->forget('default_currency');

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');

        return response()->json($msg);
        //--- Redirect Section Ends
    }

      public function status($id1, $id2)
      {
          $data = Currency::findOrFail($id1);
          $data->is_default = $id2;
          $data->update();
          $data = Currency::where('id', '!=', $id1)->update(['is_default' => 0]);
          //--- Redirect Section
          $msg = __('Data Updated Successfully.');

          return response()->json($msg);
          //--- Redirect Section Ends
      }

    public function destroy($id)
    {
        if ($id === 1) {
            return __("You cant't remove the main currency.");
        }
        $data = Currency::findOrFail($id);

        if ($data->is_default === 1) {
            Currency::where('id', '=', 1)->update(['is_default' => 1]);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');

        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
