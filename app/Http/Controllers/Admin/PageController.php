<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Pagesetting;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.page.index');
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function contact()
    {
        $data = Pagesetting::find(1);

        return view('admin.pagesetting.contact', compact('data'));
    }

    public function settings()
    {
        $data = Pagesetting::find(1);

        return view('admin.pagesetting.customize', compact('data'));
    }

    public function orderForms()
    {
        return view('admin.orderforms.index');
    }
}
