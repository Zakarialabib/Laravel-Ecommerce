<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pagesetting;
use Illuminate\Http\Request;
use Validator;

class PageSettingController extends AdminBaseController
{
    protected $rules =
    [
        'best_seller_banner'    => 'mimes:jpeg,jpg,png,svg',
        'big_save_banner'       => 'mimes:jpeg,jpg,png,svg',
        'best_seller_banner1'   => 'mimes:jpeg,jpg,png,svg',
        'big_save_banner1'      => 'mimes:jpeg,jpg,png,svg',
        'rightbanner1'          => 'mimes:jpeg,jpg,png,svg',
        'rightbanner2'          => 'mimes:jpeg,jpg,png,svg'
    ];

    protected $customs =
    [
        'best_seller_banner.mimes'  => 'Photo type must be in jpeg, jpg, png, svg.',
        'big_save_banner.mimes'     => 'Photo type must be in jpeg, jpg, png, svg.',
        'best_seller_banner1.mimes' => 'Photo type must be in jpeg, jpg, png, svg.',
        'big_save_banner1.mimes'    => 'Photo type must be in jpeg, jpg, png, svg.',
        'rightbanner1.mimes'        => 'Photo type must be in jpeg, jpg, png, svg.',
        'rightbanner2.mimes'        => 'Photo type must be in jpeg, jpg, png, svg.'
    ];

    // Page Settings All post requests will be done in this method
    public function update(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules,$this->customs);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = Pagesetting::findOrFail(1);
        $input = $request->all();

            if ($file = $request->file('best_seller_banner'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->best_seller_banner);
                $input['best_seller_banner'] = $name;
            }
            if ($file = $request->file('big_save_banner'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->big_save_banner);
                $input['big_save_banner'] = $name;
            }
            if ($file = $request->file('best_seller_banner1'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->best_seller_banner1);
                $input['best_seller_banner1'] = $name;
            }
            if ($file = $request->file('big_save_banner1'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->big_save_banner1);
                $input['big_save_banner1'] = $name;
            }
            if ($file = $request->file('rightbanner1'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->rightbanner1);
                $input['rightbanner1'] = $name;
            }
            if ($file = $request->file('rightbanner2'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->rightbanner2);
                $input['rightbanner2'] = $name;
            }

        $data->update($input);
        cache()->forget('pagesettings');
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }


    public function homeupdate(Request $request)
    {
        $data = Pagesetting::findOrFail(1);
        $input = $request->all();

        if ($request->category == ""){
            $input['category'] = 0;
        }
        if ($request->arrival_section == ""){
            $input['arrival_section'] = 0;
        }
        if ($request->our_services == ""){
            $input['our_services'] = 0;
        }
        if ($request->blog == ""){
            $input['blog'] = 0;
        }
        if ($request->popular_products == ""){
            $input['popular_products'] = 0;
        }
        if ($request->third_left_banner == ""){
            $input['third_left_banner'] = 0;
        }
        if ($request->slider == ""){
            $input['slider'] = 0;
        }
        if ($request->flash_deal == ""){
            $input['flash_deal'] = 0;
        }
        if ($request->deal_of_the_day == ""){
            $input['deal_of_the_day'] = 0;
        }
        if ($request->best_sellers == ""){
            $input['best_sellers'] = 0;
        }
        if ($request->partner == ""){
            $input['partner'] = 0;
        }
        if ($request->top_big_trending == ""){
            $input['top_big_trending'] = 0;
        }
        if ($request->top_brand == ""){
            $input['top_brand'] = 0;
        }


        $data->update($input);

        cache()->forget('pagesettings');
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }

    public function menuupdate(Request $request)
    {
        $data = Pagesetting::findOrFail(1);
        $input = $request->all();

        if ($request->home == ""){
            $input['home'] = 0;
        }
        if ($request->blog == ""){
            $input['blog'] = 0;
        }
        if ($request->faq == ""){
            $input['faq'] = 0;
        }
        if ($request->contact == ""){
            $input['contact'] = 0;
        }
        $data->update($input);
        cache()->forget('pagesettings');
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }


    public function contact()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.contact',compact('data'));
    }

    public function customize()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.customize',compact('data'));
    }

    public function best_seller()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.best_seller',compact('data'));
    }

    public function big_save()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.big_save',compact('data'));
    }

    public function page_banner()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.page_banner',compact('data'));
    }

    public function right_banner()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.right_banner',compact('data'));
    }

    public function menu_links()
    {
        $data = Pagesetting::find(1);
        return view('admin.pagesetting.menu_links',compact('data'));
    }


    //Upadte About Page Section Settings

}
