<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use stdClass;
use Exception;

class GeneralSettingController extends Controller
{
    private function setEnv($key, $value, $prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key.'='.$prev,
            $key.'='.$value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

    public function paymentsinfo()
    {
        return view('admin.generalsetting.paymentsinfo');
    }

    public function websitecontent()
    {
        return view('admin.generalsetting.websitecontent');
    }

    public function popup()
    {
        return view('admin.generalsetting.popup');
    }

    public function footer()
    {
        return view('admin.generalsetting.footer');
    }

    public function error_banner()
    {
        return view('admin.generalsetting.error_banner');
    }

    public function maintain()
    {
        return view('admin.generalsetting.maintain');
    }

    public function generalupdatepayment(Request $request)
    {
        //--- Validation Section
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
            $input = $request->all();
            $data = Generalsetting::findOrFail(1);
            $prev = $data->molly_key;

            if ($request->vendor_ship_info == '') {
                $input['vendor_ship_info'] = 0;
            }

            if ($request->instamojo_sandbox == '') {
                $input['instamojo_sandbox'] = 0;
            }

            if ($request->paypal_mode == '') {
                $input['paypal_mode'] = 'live';
            } else {
                $input['paypal_mode'] = 'sandbox';
            }

            if ($request->paytm_mode == '') {
                $input['paytm_mode'] = 'live';
            } else {
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
            'to'      => 'junajunnun@gmail.com',
            'subject' => 'Test Sms',
            'body'    => 'Test Body',
        ];

        $data = [
            'email_body' => $datas['body'],
        ];

        $objDemo = new stdClass();
        $objDemo->to = $datas['to'];
        $objDemo->from = $request->from_email;
        $objDemo->title = $request->from_name;
        $objDemo->subject = $datas['subject'];

        try {
            Mail::send('admin.email.mailbody', $data, function ($message) use ($objDemo) {
                $message->from($objDemo->from, $objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
            });
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

        $maildata->update($input);

        //--- Redirect Section
        $msg = 'Mail Data Updated Successfully.';

        return response()->json($msg);
        //--- Redirect Section Ends
    }
}
