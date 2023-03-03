<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        return view('admin.dashboard', compact('days', 'sales', 'customData', 'recentOrders', 'recentUsers'));
    }

    public function profile()
    {
        $data = Auth::user();

        return view('admin.profile', compact('data'));
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
                if ($request->newpass === $request->renewpass) {
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

    public function changeLanguage($locale)
    {
        Session::put('code', $locale);
        $language = Session::get('code');

        return redirect()->back();
    }
}
