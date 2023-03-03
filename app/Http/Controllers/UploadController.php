<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->file('image')) {
            if (is_array($request->image)) {
                $path = collect($request->image)->map->store('tmp-editor-uploads');
            } else {
                $path = $request->image->store('tmp-editor-uploads');
            }

            return response()->json([
                'url' => $path,
            ], 200);
        }

        return;
    }
}
