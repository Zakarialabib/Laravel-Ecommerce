<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArrivalSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArrivalsectionController extends Controller
{
   
    public function index(){
        return view('admin.arrival.index');
    }
    public function create(){
        return view('admin.arrival.create');
    }

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
        //--- Logic Section
        $data = new ArrivalSection();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/arrival',$name);
            $input['photo'] = $name;
        }
        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New Data Added Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    public function edit($id)
    {
        $data = ArrivalSection::findOrFail($id);
        return view('admin.arrival.edit',compact('data'));
    }

    public function status($id1,$id2)
    {
        ArrivalSection::findOrFail($id1)->update([
            'status' => $id2
        ]);
    }

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
        $data = ArrivalSection::findOrFail($id);
        $input = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/arrival',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/arrival/'.$data->photo)) {
                        unlink(public_path().'/assets/images/arrival/'.$data->photo);
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

    public function destroy($id)
    {
        $data = ArrivalSection::findOrFail($id);
        //If Photo Doesn't Exist
        if($data->photo == null){
            $data->delete();
            //--- Redirect Section
            $msg = __('Data Deleted Successfully.');
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        //If Photo Exist
        if (file_exists(public_path().'/assets/images/arrival/'.$data->photo)) {
            unlink(public_path().'/assets/images/arrival/'.$data->photo);
        }
        $data->delete();
        //--- Redirect Section
        $msg = __('Data Deleted Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
