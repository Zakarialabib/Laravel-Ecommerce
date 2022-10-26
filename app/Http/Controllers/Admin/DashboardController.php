<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Blog,
    Models\User,
    Models\Order,
    Models\Product,
    Models\Counter
};
use Illuminate\{
    Http\Request,
    Support\Facades\Hash
};
use Auth;
use Validator;
use InvalidArgumentException;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {

        $data['pending'] = Order::where('status','=','pending')->get();
        $data['processing'] = Order::where('status','=','processing')->get();
        $data['completed'] = Order::where('status','=','completed')->get();
        $data['days'] = "";
        $data['sales'] = "";
        for($i = 0; $i < 30; $i++) {
            $data['days'] .= "'".date("d M", strtotime('-'. $i .' days'))."',";

            $data['sales'] .=  "'".Order::where('status','=','completed')->whereDate('created_at', '=', date("Y-m-d", strtotime('-'. $i .' days')))->count()."',";
        }
        $data['users'] = User::all();
        $data['products'] = Product::all();
        $data['blogs'] = Blog::all();
        $data['pproducts'] = Product::latest('id')->take(5)->get();
        $data['rorders'] = Order::latest('id')->take(5)->get();
        $data['poproducts'] = Product::latest('id')->take(5)->get();
        $data['rusers'] = User::latest('id')->take(5)->get();

        return view('admin.dashboard',$data);
    }

    public function profile()
    {
        $data = Auth::user();
        return view('admin.profile',compact('data'));
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section

        $rules =
        [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'email' => 'unique:admins,email,'.Auth::user()->id
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = Auth::user();
            if ($file = $request->file('photo'))
            {
                $name = \PriceHelper::ImageCreateName($file);
                $file->move('assets/images/admins/',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/admins/'.$data->photo)) {
                        unlink(public_path().'/assets/images/admins/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }
        $data->update($input);
        $msg = __('Successfully updated your profile');
        return response()->json($msg);
    }

    public function passwordreset()
    {
        $data = Auth::user();
        return view('admin.password',compact('data'));
    }

    public function changepass(Request $request)
    {
        $admin = Auth::user();
        if ($request->cpass){
            if (Hash::check($request->cpass, $admin->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    return response()->json(array('errors' => [ 0 => __('Confirm password does not match.') ]));
                }
            }else{
                return response()->json(array('errors' => [ 0 => __('Current password Does not match.') ]));
            }
        }
        $admin->update($input);
        $msg = __('Successfully changed your password');
        return response()->json($msg);
    }

    public function generate_bkup()
    {
        $bkuplink = "";
        $chk = file_get_contents('backup.txt');
        if ($chk != ""){
            $bkuplink = url($chk);
        }
        return view('admin.movetoserver',compact('bkuplink','chk'));
    }


    public function clear_bkup()
    {
        $destination  = public_path().'/install';
        $bkuplink = "";
        $chk = file_get_contents('backup.txt');
        if ($chk != ""){
            unlink(public_path($chk));
        }

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }
        $handle = fopen('backup.txt','w+');
        fwrite($handle,"");
        fclose($handle);
        //return "No Backup File Generated.";
        return redirect()->back()->with('success','Backup file Deleted Successfully!');
    }


   
    public function movescript(){
        ini_set('max_execution_time', 3000);

        $destination  = public_path().'/install';
        $chk = file_get_contents('backup.txt');
        if ($chk != ""){
            unlink(public_path($chk));
        }

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }

        $src = base_path().'/vendor/update';
        $this->recurse_copy($src,$destination);
        $files = public_path();
        $bkupname = 'Backup-By-Hotech&Soft-'.date('Y-m-d').'.zip';

        $zipper = new \Chumper\Zipper\Zipper;

        $zipper->make($bkupname)->add($files);

        $zipper->remove($bkupname);

        $zipper->close();

        $handle = fopen('backup.txt','w+');
        fwrite($handle,$bkupname);
        fclose($handle);

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }
        return response()->json(['status' => 'success','backupfile' => url($bkupname),'filename' => $bkupname],200);
    }

    public function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

}
