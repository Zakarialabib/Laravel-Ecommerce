<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('user_access'), 403);

        return view('admin.user.index');
    }

    public function permissions()
    {
        // abort_if(Gate::denies('user_access'), 403);

        return view('admin.user.permissions');
    }
}
