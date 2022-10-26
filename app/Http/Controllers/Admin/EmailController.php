<?php

namespace App\Http\Controllers\Admin;

use App\{
    Classes\GeniusMailer,
    Models\EmailTemplate,
    Models\Generalsetting,
    Models\User
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{

    public function index(){
        return view('admin.email.index');
    }

    public function config(){
        return view('admin.email.config');
    }

    public function edit($id)
    {
        $data = EmailTemplate::findOrFail($id);
        return view('admin.email.edit',compact('data'));
    }

    public function groupemail()
    {
        $config = Generalsetting::findOrFail(1);
        return view('admin.email.group',compact('config'));
    }

    public function groupemailpost(Request $request)
    {
        $config = Generalsetting::findOrFail(1);
        if($request->type == 0)
        {
        $users = User::all();
        //Sending Email To Users
        foreach($users as $user)
        {
            if($config->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);            
            }
            else
            {
               $to = $user->email;
               $subject = $request->subject;
               $msg = $request->body;
                $headers = "From: ".$config->from_name."<".$config->from_email.">";
               mail($to,$subject,$msg,$headers);
            }  
        } 
        //--- Redirect Section          
        $msg = __('Email Sent Successfully.');
        return response()->json($msg);    
        //--- Redirect Section Ends  
        }

        else if($request->type == 1)
        {
        $users = User::where('is_vendor','=','2')->get();
        //Sending Email To Vendors        
        foreach($users as $user)
        {
            if($config->is_smtp == 1)
            {
                $data = [
                    'to' => $user->email,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);            
            }
            else
            {
               $to = $user->email;
               $subject = $request->subject;
               $msg = $request->body;
                $headers = "From: ".$config->from_name."<".$config->from_email.">";
               mail($to,$subject,$msg,$headers);
            }  
        } 
        //--- Redirect Section          
        $msg = __('Email Sent Successfully.');
        return response()->json($msg);    
        //--- Redirect Section Ends  
        }


    }

    public function update(Request $request, $id)
    {
        $data = EmailTemplate::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Redirect Section          
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);    
        //--- Redirect Section Ends  
    }

}
