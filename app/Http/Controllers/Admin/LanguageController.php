<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function index()
    {
        return view('admin.language.index');
    }
}
