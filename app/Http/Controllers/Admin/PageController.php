<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pagesetting;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.page.index');
    }

    public function orderForms()
    {
        return view('admin.orderforms.index');
    }
}
