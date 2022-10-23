<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Validator;
use Datatables;

class BannerController extends AdminBaseController
{

    //*** JSON Request
    public function datatables($type)
    {
         $datas = Banner::where('type','=',$type)->latest('id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Banner $data) {
                                $photo = $data->photo ? url('assets/images/banners/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })
                            ->addColumn('action', function(Banner $data) {
                                return '<div class="action-list"><a data-href="' . route('admin-sb-edit',$data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>'.__('Edit').'</a><a href="javascript:;" data-href="' . route('admin-sb-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
                            }) 
                            ->rawColumns(['photo', 'action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('admin.banner.index');
    }

    //*** GET Request
    public function large()
    {
        return view('admin.banner.large');
    }

    //*** GET Request
    public function bottom()
    {
        return view('admin.banner.bottom');
    }

    //*** GET Request
    public function create()
    {
        return view('admin.banner.create');
    }

    //*** GET Request
    public function largecreate()
    {
        return view('admin.banner.largecreate');
    }

    //*** GET Request
    public function bottomcreate()
    {
        return view('admin.banner.bottomcreate');
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
        $data = new Banner();
        $input = $request->all();
        if ($file = $request->file('photo')) 
         { 
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/banners',$name);           
            $input['photo'] = $name;
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
        $data = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('data'));
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
        $data = Banner::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo')) 
            {              
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/banners',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
                        unlink(public_path().'/assets/images/banners/'.$data->photo);
                    }
                }            
            $input['photo'] = $name;
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
        $data = Banner::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section     
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);      
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/banners/'.$data->photo)) {
            unlink(public_path().'/assets/images/banners/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section     
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }
}
