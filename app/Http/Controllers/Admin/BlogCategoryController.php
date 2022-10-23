<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class BlogCategoryController extends AdminBaseController
{
    public function index(){
        return view('admin.blog.category.index');
    }

    public function create(){
        return view('admin.blog.category.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'name' => 'unique:blog_categories',
               'slug' => 'unique:blog_categories'
                ];
        $customs = [
               'name.unique' => __('This name has already been taken.'),
               'slug.unique' => __('This slug has already been taken.')
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new BlogCategory;
        $input = $request->all();
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
        $data = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'name' => 'unique:blog_categories,name,'.$id,
               'slug' => 'unique:blog_categories,slug,'.$id
                ];
        $customs = [
               'name.unique' => __('This name has already been taken.'),
               'slug.unique' => __('This slug has already been taken.')
                   ];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = BlogCategory::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section          
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);    
        //--- Redirect Section Ends  

    }

    //*** GET Request
    public function destroy($id)
    {
        $data = BlogCategory::findOrFail($id);

        //--- Check If there any blogs available, If Available Then Delete it 
        if($data->blogs->count() > 0)
        {
            foreach ($data->blogs as $element) {
                $element->delete();
            }
        }
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends   
    }
}