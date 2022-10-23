<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PageController extends AdminBaseController
{

    public function index(){
        return view('admin.page.index');
    }

    public function create(){
        return view('admin.page.create');
    }

    //*** POST Request
    public function store(Request $request)
    {
        //--- Validation Section
        $slug = $request->slug;
        $main = array('home','faq','contact','blog','cart','checkout');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));
        }
        $rules = ['slug' => 'unique:pages'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Page();
        $input = $request->all();

        if (!empty($request->meta_tag))
         {
            $input['meta_tag'] = implode(',', $request->meta_tag);
         }
        if ($request->secheck == "")
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin-page-index").'">View Page Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $data = Page::findOrFail($id);
        return view('admin.page.edit',compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {
        //--- Validation Section
        $slug = $request->slug;
        $main = array('home','faq','contact','blog','cart','checkout');
        if (in_array($slug, $main)) {
        return response()->json(array('errors' => [ 0 => 'This slug has already been taken.' ]));
        }
        $rules = ['slug' => 'unique:pages,slug,'.$id,
                'photo'      => 'mimes:jpeg,jpg,png,svg'];
        $customs = ['slug.unique' => 'This slug has already been taken.'];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Page::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/pages',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/pages/'.$data->photo)) {
                        unlink(public_path().'/assets/images/pages/'.$data->photo);
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
        if ($request->secheck == "")
         {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
         }
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin-page-index").'">View Page Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

      //*** GET Request Header
      public function header($id1,$id2)
        {
            $data = Page::findOrFail($id1);
            $data->header = $id2;
            $data->update();
        }

      //*** GET Request Footer
      public function footer($id1,$id2)
        {
            $data = Page::findOrFail($id1);
            $data->footer = $id2;
            $data->update();
        }


    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Page::findOrFail($id);
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    
}
