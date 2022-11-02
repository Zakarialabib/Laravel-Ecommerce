<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Blog,
    Models\BlogCategory
};
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
   
    public function index(){
        return view('admin.blog.index');
    }

    public function blogcategories(){
        return view('admin.blog.category.index');
    }

    //*** GET Request
    public function create()
    {
        $cats = BlogCategory::all();
        return view('admin.blog.post.create',compact('cats'));
    }

    public function settings(){
        return view('admin.blog.settings');
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
        $data = new Blog();
        $input = $request->all();

        $slug=Str::slug($request->title).Str::random(4);

        if ($file = $request->file('photo'))
         {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/blogs',$name);
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
         $input['slug']=$slug;

        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New Data Added Successfully.').'<a href="'.route("admin.blogs").'">'.__("View Post Lists").'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request
    public function edit($id)
    {
        $cats = BlogCategory::all();
        $data = Blog::findOrFail($id);
        return view('admin.blog.post.edit',compact('data','cats'));
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
        $data = Blog::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/blogs',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/blogs/'.$data->photo)) {
                        unlink(public_path().'/assets/images/blogs/'.$data->photo);
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
         $input['slug']=Str::slug($request->title).Str::random(4);
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.').'<a href="'.route("admin.blogs").'">'.__("View Post Lists").'</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** GET Request Delete
    public function destroy($id)
    {
        $data = Blog::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/blogs/'.$data->photo)) {
            unlink(public_path().'/assets/images/blogs/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
