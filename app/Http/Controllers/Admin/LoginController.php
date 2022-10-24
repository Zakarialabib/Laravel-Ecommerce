<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use App\Models\Generalsetting;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

class LoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
      return view('admin.login');
    }

    public function login(Request $request)
    {
        //--- Validation Section
        $rules = [
                  'email'   => 'required|email',
                  'password' => 'required'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

      // Attempt to log the user in
      if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return response()->json(route('admin.dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
          return response()->json(array('errors' => [ 0 => 'Credentials Doesn\'t Match !' ]));
    }

    public function showForgotForm()
    {
      return view('admin.forgot');
    }

    public function forgot(Request $request)
    {
      $gs = Generalsetting::findOrFail(1);
      $input =  $request->all();
      if (Admin::where('email', '=', $request->email)->count() > 0) {
      // user found
      $admin = Admin::where('email', '=', $request->email)->firstOrFail();
      $token = md5(time().$admin->name.$admin->email);

      $file = fopen(public_path().'/project/storage/tokens/'.$token.'.data','w+');
      fwrite($file,$admin->id);
      fclose($file);

      $subject = "Reset Password Request";
      $msg = "Please click this link : ".'<a href="'.route('admin.change.token',$token).'">'.route('admin.change.token',$token).'</a>'.' to change your password.';
      if($gs->is_smtp == 1)
      {
          $data = [
                  'to' => $request->email,
                  'subject' => $subject,
                  'body' => $msg,
          ];

          $mailer = new GeniusMailer();
          $mailer->sendCustomMail($data);
      }
      else
      {
          $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
          mail($request->email,$subject,$msg,$headers);
      }
      return response()->json('Verification Link Sent Successfully!. Please Check your email.');
      }
      else{
      // user not found
      return response()->json(array('errors' => [ 0 => 'No Account Found With This Email.' ]));
      }
    }

    public function showChangePassForm($token)
    {
      if (file_exists(public_path().'/project/storage/tokens/'.$token.'.data')){
        $id = file_get_contents(public_path().'/project/storage/tokens/'.$token.'.data');
        return view('admin.changepass',compact('id','token'));
      }
    }

    public function changepass(Request $request)
    {
        $id = $request->admin_id;
        $admin =  Admin::findOrFail($id);
        $token = $request->file_token;
        if ($request->cpass){
            if (Hash::check($request->cpass, $admin->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    return response()->json(array('errors' => [ 0 => 'Confirm password does not match.' ]));
                }
            }else{
                return response()->json(array('errors' => [ 0 => 'Current password Does not match.' ]));
            }
        }
        $admin->update($input);

        unlink(public_path().'/project/storage/tokens/'.$token.'.data');

        $msg = 'Successfully changed your password.<a href="'.route('admin.login').'"> Login Now</a>';
        return response()->json($msg);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
