<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;

class SectionController extends Controller
{
    // Index Section
    public function index()
    {
        return view('admin.section.index');
    }

    // Add Section
    public function create()
    {
        return view('admin.section.create');
    }

    // Section Edit
    public function edit(Section $section)
    {
        return view('admin.section.edit', compact('section'));
    }
}
