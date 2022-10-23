<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use Datatables;

class ReportController extends AdminBaseController
{

	    //*** JSON Request
	    public function datatables()
	    {
	         $datas = Report::latest('id')->get();
	         //--- Integrating This Collection Into Datatables
	         return Datatables::of($datas)
	                            ->addColumn('product', function(Report $data) {
									$name =  mb_strlen(strip_tags($data->name),'UTF-8') > 50 ? mb_substr(strip_tags($data->name),0,50,'UTF-8').'...' : strip_tags($data->name);
	                                $product = '<a href="'.route('front.product', $data->product->slug).'" target="_blank">'.$name.'</a>';
	                                return $product;
	                            })
	                            ->addColumn('reporter', function(Report $data) {
	                                $name = $data->user->name;
	                                return $name;
	                            })
	                            ->addColumn('title', function(Report $data) {
	                                $text = mb_strlen(strip_tags($data->title),'UTF-8') > 250 ? mb_substr(strip_tags($data->title),0,250,'UTF-8').'...' : strip_tags($data->title);
	                                return $text;
	                            })
	                            ->addColumn('action', function(Report $data) {
	                                return '<div class="action-list"><a data-href="' . route('admin-report-show',$data->id) . '" class="view details-width" data-toggle="modal" data-target="#modal1"> <i class="fas fa-eye"></i>'.__('Details').'</a><a href="javascript:;" data-href="' . route('admin-report-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
	                            }) 
	                            ->rawColumns(['product','action'])
	                            ->toJson(); //--- Returning Json Data To Client Side
		}
		
		public function index(){
			return view('admin.report.index');
		}

	    //*** GET Request
	    public function show($id)
	    {
	        $data = Report::findOrFail($id);
	        return view('admin.report.show',compact('data'));
	    }

	    //*** GET Request Delete
		public function destroy($id)
		{
		    $data = Report::findOrFail($id);
		    $data->delete();
		    //--- Redirect Section     
		    $msg = __('Data Deleted Successfully.');
		    return response()->json($msg);      
		    //--- Redirect Section Ends    
		}
}