<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Brand
};
use Illuminate\Http\Request;
use Validator;

class BrandController extends AdminBaseController
{

    public function index(){
        return view('admin.brand.index');
    }

    public function create(){
        return view('admin.brand.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Brand();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         {      
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/partner',$name);           
            $input['photo'] = $name;
        } 
        if (!empty($request->meta_tag)) 
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);       
         }  
        if (!empty($request->tags)) 
         {
            $input['tags'] = implode(',', $request->tags);       
         }
        if ($request->secheck == "") 
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;         
         } 
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
        $data = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Brand::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/partner',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/partner/'.$data->photo)) {
                        unlink(public_path().'/assets/images/partner/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
            } 
        if (!empty($request->meta_tag)) 
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);       
         } 
        else {
            $input['meta_tag'] = null;
         }
        if (!empty($request->tags)) 
         {
            $input['tags'] = implode(',', $request->tags);       
         }
        else {
            $input['tags'] = null;
         } 
        if ($request->secheck == "") 
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;         
         } 
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
        $data = Brand::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/partner/'.$data->photo)) {
            unlink(public_path().'/assets/images/partner/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
}
