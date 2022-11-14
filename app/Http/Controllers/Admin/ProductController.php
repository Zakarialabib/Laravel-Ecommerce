<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Product,
    Models\Gallery,
    Models\Category,
    Models\Currency,
    Models\Attribute,
    Models\Subcategory,
    Models\Childcategory,
    Models\AttributeOption
};
use Illuminate\{
    Http\Request,
    Support\Str
};
use App\Http\Controllers\Controller;
use DB;
use Image;
use Validator;

class ProductController extends Controller
{
  
    public function index(){
        return view('admin.product.index');
    }

    public function productsettings(){
        return view('admin.product.settings');
    }
   
    public function settingUpdate(Request $request)
    {
        //--- Logic Section
        $input = $request->all();
        $data = \App\Models\Generalsetting::findOrFail(1);

        if (!empty($request->product_page)) {
            $input['product_page'] = implode(',', $request->product_page);
        }
        else {
            $input['product_page'] = null;
        }

        if (!empty($request->wishlist_page)) {
            $input['wishlist_page'] = implode(',', $request->wishlist_page);
        }
        else {
            $input['wishlist_page'] = null;
        }

        cache()->forget('generalsettings');

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

}
