<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class SectionController extends Controller
{
    public function index(): View|Factory
    {
        return view('admin.section.index');
    }
}
