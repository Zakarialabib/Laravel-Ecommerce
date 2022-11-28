<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Blog, Order, Product, User};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customData = [
            'today' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now())->count(),
                'ordersCount' => Order::whereDate('created_at', '>=', Carbon::now())->count(),
               'orderPending' => Order::where('status', '=', 1)->whereDate('created_at', '>=', Carbon::now())->count(),
                'orderProcessing' => Order::where('status', '=', 2)->whereDate('created_at', '>=', Carbon::now())->count(),
                'orderCompleted' => Order::where('status', '=', 3)->whereDate('created_at', '>=', Carbon::now())->count(),
            ],
            'month' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now()->subMonth())->count(),
                'ordersCount' => Order::whereDate('created_at', '>=', Carbon::now()->subMonth())->count(),
                '$orderPending' => Order::where('status', '=', 1)->whereDate('created_at', '>=', Carbon::now()->subMonth())->count(),
                'orderProcessing' => Order::where('status', '=', 2)->whereDate('created_at', '>=', Carbon::now()->subMonth())->count(),
                'orderCompleted' => Order::where('status', '=', 3)->whereDate('created_at', '>=', Carbon::now()->subMonth())->count(),
            ],
            'semi' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now()->subMonths(6))->count(),
                'ordersCount' => Order::whereDate('created_at', '>=', Carbon::now()->subMonths(6))->count(),
                'orderPending' => Order::where('status', '=', 1)->whereDate('created_at', '>=', Carbon::now()->subMonths(6))->count(),
                'orderProcessing' => Order::where('status', '=', 2)->whereDate('created_at', '>=', Carbon::now()->subMonths(6))->count(),
                'orderCompleted' => Order::where('status', '=', 3)->whereDate('created_at', '>=', Carbon::now()->subMonths(6))->count(),
            ],
            'year' => [
                'countCustomers' => User::whereDate('created_at', '>=', Carbon::now()->subYear())->count(),
                'ordersCount' => Order::whereDate('created_at', '>=', Carbon::now()->subYear())->count(),
                'orderPending' => Order::where('status', '=', 1)->whereDate('created_at', '>=', Carbon::now()->subYear())->count(),
                'orderProcessing' => Order::where('status', '=', 2)->whereDate('created_at', '>=', Carbon::now()->subYear())->count(),
                'orderCompleted' => Order::where('status', '=', 3)->whereDate('created_at', '>=', Carbon::now()->subYear())->count(),
            ],
        ];

        $recentOrders = Order::latest('id')->take(5)->get();
        $recentUsers = User::latest('id')->take(5)->get();

        $days = '';
        $sales = '';
        for ($i = 0; $i < 30; $i++) {
            $days .= "'".date('d M', strtotime('-'.$i.' days'))."',";

            $sales .= "'".Order::where('status', '=', 3)->whereDate('created_at', '=', date('Y-m-d', strtotime('-'.$i.' days')))->count()."',";
        }        

        return view('admin.dashboard', compact('days','sales','customData','recentOrders','recentUsers'));
    }

    public function profile()
    {
        $data = Auth::user();

        return view('admin.profile', compact('data'));
    }

    public function profileupdate(Request $request)
    {
        //--- Validation Section

        $rules =
        [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'email' => 'unique:admins,email,'.Auth::user()->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = Auth::user();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/admins/', $name);
            if ($data->photo != null) {
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

        return view('admin.password', compact('data'));
    }

    public function changepass(Request $request)
    {
        $admin = Auth::user();
        if ($request->cpass) {
            if (Hash::check($request->cpass, $admin->password)) {
                if ($request->newpass == $request->renewpass) {
                    $input['password'] = Hash::make($request->newpass);
                } else {
                    return response()->json(['errors' => [0 => __('Confirm password does not match.')]]);
                }
            } else {
                return response()->json(['errors' => [0 => __('Current password Does not match.')]]);
            }
        }
        $admin->update($input);
        $msg = __('Successfully changed your password');

        return response()->json($msg);
    }

    public function generate_bkup()
    {
        $bkuplink = '';
        $chk = file_get_contents('backup.txt');
        if ($chk != '') {
            $bkuplink = url($chk);
        }

        return view('admin.movetoserver', compact('bkuplink', 'chk'));
    }

    public function clear_bkup()
    {
        $destination = public_path().'/install';
        $bkuplink = '';
        $chk = file_get_contents('backup.txt');
        if ($chk != '') {
            unlink(public_path($chk));
        }

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }
        $handle = fopen('backup.txt', 'w+');
        fwrite($handle, '');
        fclose($handle);
        //return "No Backup File Generated.";
        return redirect()->back()->with('success', 'Backup file Deleted Successfully!');
    }

    public function movescript()
    {
        ini_set('max_execution_time', 3000);

        $destination = public_path().'/install';
        $chk = file_get_contents('backup.txt');
        if ($chk != '') {
            unlink(public_path($chk));
        }

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }

        $src = base_path().'/vendor/update';
        $this->recurse_copy($src, $destination);
        $files = public_path();
        $bkupname = 'Backup-By-Hotech&Soft-'.date('Y-m-d').'.zip';

        $zipper = new \Chumper\Zipper\Zipper;

        $zipper->make($bkupname)->add($files);

        $zipper->remove($bkupname);

        $zipper->close();

        $handle = fopen('backup.txt', 'w+');
        fwrite($handle, $bkupname);
        fclose($handle);

        if (is_dir($destination)) {
            $this->deleteDir($destination);
        }

        return response()->json(['status' => 'success', 'backupfile' => url($bkupname), 'filename' => $bkupname], 200);
    }

    public function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src.'/'.$file)) {
                    $this->recurse_copy($src.'/'.$file, $dst.'/'.$file);
                } else {
                    copy($src.'/'.$file, $dst.'/'.$file);
                }
            }
        }
        closedir($dir);
    }

    public function deleteDir($dirPath)
    {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath.'*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function changeLanguage($locale)
    {
        Session::put('code', $locale);
        $language = Session::get('code');

        return redirect()->back();
    }
}
