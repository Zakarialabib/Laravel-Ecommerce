<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;

class LanguageController extends Controller
{
  
    public function index()
    {
        return view('admin.language.index');
    }
}
