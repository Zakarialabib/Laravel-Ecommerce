<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class CategoryController extends AdminBaseController
{

    public function index(){
        return view('admin.category.index');
    }

    public function create(){
        return view('admin.category.create');
    }
    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'slug' => 'unique:categories|regex:/^[a-zA-Z0-9\s-]+$/',
            'image' => 'required|mimes:jpeg,jpg,png,svg'
                 ];
        $customs = [
            'photo.mimes' => __('Icon Type is Invalid.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
            'image.required' => __('Banner Image is required.'),
            'image.mimes' => __('Banner Image Type is Invalid.')
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Category();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/categories',$name);
            $input['photo'] = $name;
        }
        if ($file = $request->file('image'))
        {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/categories',$name);
            $input['image'] = $name;
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
        $data = Category::findOrFail($id);
        return view('admin.category.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
        	'photo' => 'mimes:jpeg,jpg,png,svg',
            'slug' => 'unique:categories,slug,'.$id.'|regex:/^[a-zA-Z0-9\s-]+$/',
            'image' => 'mimes:jpeg,jpg,png,svg'
        		 ];
        $customs = [
            'photo.mimes' => __('Icon Type is Invalid.'),
            'slug.unique' => __('This slug has already been taken.'),
            'slug.regex' => __('Slug Must Not Have Any Special Characters.'),
            'image.mimes' => __('Banner Image Type is Invalid.')
        		   ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Category::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/categories',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
                        unlink(public_path().'/assets/images/categories/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }
            if ($file = $request->file('image'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/categories',$name);
                $input['image'] = $name;
            }


        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Status
      public function status($id1,$id2)
      {
          $data = Category::findOrFail($id1);
          $data->status = $id2;
          $data->update();
          //--- Redirect Section
          $msg = __('Status Updated Successfully.');
          return response()->json($msg);
          //--- Redirect Section Ends
      }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        $msg = __('Remove the Attributes first !');
        return response()->json($msg);
        //--- Redirect Section Ends
        }

        if($data->subs->count()>0)
        {
        //--- Redirect Section
        $msg = __('Remove the subcategories first !');
        return response()->json($msg);
        //--- Redirect Section Ends
        }
        if($data->products->count()>0)
        {
        //--- Redirect Section
        $msg = __('Remove the products first !');
        return response()->json($msg);
        //--- Redirect Section Ends
        }

        //If Photo Exist
        if (file_exists(public_path().'/assets/images/categories/'.$data->photo)) {
            unlink(public_path().'/assets/images/categories/'.$data->photo);
        }
        if (file_exists(public_path().'/assets/images/categories/'.$data->image)) {
            unlink(public_path().'/assets/images/categories/'.$data->image);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}