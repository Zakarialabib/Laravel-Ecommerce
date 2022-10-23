<?php

namespace App\Http\Controllers\Admin;

use App\Models\Generalsetting;
use Illuminate\{
    Http\Request,
    Support\Facades\Mail
};

use Config;
use Validator;

class GeneralSettingController extends AdminBaseController
{
    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affilate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner_404'  => 'mimes:jpeg,jpg,png,svg',
        'error_banner_500'  => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'user_image'        => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'       => 'mimes:jpeg,jpg,png,svg',
    ];

    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function paymentsinfo(){
        return view('admin.generalsetting.paymentsinfo');
    }

    public function logo(){
        return view('admin.generalsetting.logo');
    }

    public function favicon(){
        return view('admin.generalsetting.favicon');
    }

    public function loader(){
        return view('admin.generalsetting.loader');
    }

    public function websitecontent(){
        return view('admin.generalsetting.websitecontent');
    }
    public function popup(){
        return view('admin.generalsetting.popup');
    }
    public function breadcrumb(){
        return view('admin.generalsetting.breadcrumb');
    }

    public function footer(){
        return view('admin.generalsetting.footer');
    }

    public function affilate(){
        return view('admin.generalsetting.affilate');
    }

    public function error_banner(){
        return view('admin.generalsetting.error_banner');
    }



    public function maintain(){
        return view('admin.generalsetting.maintain');
    }

    public function deal(){

        return view('admin.pagesetting.deal');
    }

    public function vendor_color(){
        return view('admin.generalsetting.vendor_color');
    }

    public function user_image(){
        return view('admin.generalsetting.user_image');
    }

    // Genereal Settings All post requests will be done in this method
    public function generalupdate(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = Generalsetting::findOrFail(1);
            if ($file = $request->file('logo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->logo);
                $input['logo'] = $name;
            }
            if ($file = $request->file('favicon'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('deal_background'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->favicon);
                $input['deal_background'] = $name;
            }

            if ($file = $request->file('breadcrumb_banner'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->breadcrumb_banner);
                $input['breadcrumb_banner'] = $name;
            }
            if ($file = $request->file('loader'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->admin_loader);
                $input['admin_loader'] = $name;
            }
            if ($file = $request->file('affilate_banner'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->affilate_banner);
                $input['affilate_banner'] = $name;
            }
            if ($file = $request->file('error_banner_404'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->error_banner_404);
                $input['error_banner_404'] = $name;
            }
            if ($file = $request->file('error_banner_500'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->error_banner_500);
                $input['error_banner_500'] = $name;
            }
            if ($file = $request->file('popup_background'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->popup_background);
                $input['popup_background'] = $name;
            }
            if ($file = $request->file('invoice_logo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->invoice_logo);
                $input['invoice_logo'] = $name;
            }
            if ($file = $request->file('user_image'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->user_image);
                $input['user_image'] = $name;
            }

            if ($file = $request->file('footer_logo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $data->upload($name,$file,$data->footer_logo);
                $input['footer_logo'] = $name;
            }

            if (!empty($request->product_page))
            {
               $input['product_page'] = implode(',', $request->product_page);
            }
            else {
                $input['product_page'] = null;
            }


            if($request->capcha_secret_key){
                $this->setEnv('NOCAPTCHA_SECRET',$request->capcha_secret_key,env('NOCAPTCHA_SECRET'));
            }
            if($request->capcha_site_key){
                $this->setEnv('NOCAPTCHA_SITEKEY',$request->capcha_site_key,env('NOCAPTCHA_SITEKEY'));
            }

        cache()->forget('generalsettings');
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
        }
    }

    public function generalupdatepayment(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();
        $data = Generalsetting::findOrFail(1);
        $prev = $data->molly_key;

        if ($request->vendor_ship_info == ""){
            $input['vendor_ship_info'] = 0;
        }

        if ($request->instamojo_sandbox == ""){
            $input['instamojo_sandbox'] = 0;
        }

        if ($request->paypal_mode == ""){
            $input['paypal_mode'] = 'live';
        }
        else {
            $input['paypal_mode'] = 'sandbox';
        }

        if ($request->paytm_mode == ""){
            $input['paytm_mode'] = 'live';
        }
        else {
            $input['paytm_mode'] = 'sandbox';
        }
        $data->update($input);

        cache()->forget('generalsettings');

        // Set Molly ENV

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __(__('Data Updated Successfully.'));
        return response()->json($msg);
        //--- Redirect Section Ends
        }
    }

    public function generalMailUpdate(Request $request)
    {
        $input = $request->all();
        $maildata = Generalsetting::findOrFail(1);

        Config::set('mail.driver', $request->mail_driver);
        Config::set('mail.host', $request->mail_host);
        Config::set('mail.port', $request->mail_port);
        Config::set('mail.encryption', $request->mail_encryption);
        Config::set('mail.username', $request->mail_user);
        Config::set('mail.password', $request->mail_pass);

            $datas = [
                    'to' => 'junajunnun@gmail.com',
                    'subject' => 'Test Sms',
                    'body' => 'Test Body',
            ];

            $data = [
                'email_body' => $datas['body']
            ];

            $objDemo = new \stdClass();
            $objDemo->to = $datas['to'];
            $objDemo->from = $request->from_email;
            $objDemo->title = $request->from_name;
            $objDemo->subject = $datas['subject'];
            try{
                Mail::send('admin.email.mailbody',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            }
            catch (\Exception $e){
                return response()->json($e->getMessage());
            }


        $maildata->update($input);

        //--- Redirect Section
        $msg = 'Mail Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    // Status Change Method -> GET Request
    public function status($field,$value)
    {
        $prev = '';
        $data = Generalsetting::findOrFail(1);
        if($field == 'is_debug'){
            $prev = $data->is_debug == 1 ? 'true':'false';
        }
        $data[$field] = $value;
        $data->update();
        if($field == 'is_debug'){
            $now = $data->is_debug == 1 ? 'true':'false';
            $this->setEnv('APP_DEBUG',$now,$prev);
        }
        cache()->forget('generalsettings');
        //--- Redirect Section
        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends

    }
}
