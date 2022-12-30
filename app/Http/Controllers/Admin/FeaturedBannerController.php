<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FeaturedBannerController extends Controller
{
    public function index()
    {
        return view('admin.featuredbanner.index');
    }
}
