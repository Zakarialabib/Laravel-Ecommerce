<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
  
    public function index(){
        return view('admin.faq.index');
    }

    public function create(){
        return view('admin.faq.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $data = new Faq();
        $input = $request->all();
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section        
        $msg = __('New Data Added Successfully.').'<a href="'.route("admin-faq-index").'">'.__("View Faq Lists").'</a>';
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }


    public function edit($id)
    {
        $data = Faq::findOrFail($id);
        return view('admin.faq.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section

        //--- Validation Section Ends

        //--- Logic Section
        $data = Faq::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section     
        $msg = __('Data Updated Successfully.').'<a href="'.route("admin-faq-index").'">'.__("View Faq Lists").'</a>';
        return response()->json($msg);    
        //--- Redirect Section Ends              
    }
    
    public function destroy($id)
    {
        $data = Faq::findOrFail($id);
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
}