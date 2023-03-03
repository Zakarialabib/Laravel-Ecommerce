<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Redirect;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notFound(Request $request)
    {
        try {
            // Check if the unfound URL already exists in the database
            $redirect = Redirect::where('old_url', $request->url())->first();
            if ($redirect) {
                // If it does, redirect to the new URL
                return redirect($redirect->new_url);
            }

            // If not, store the unfound URL in the database and redirect to the app URL
            Redirect::create([
                'old_url' => $request->url(),
                'new_url' => url('/'),
            ]);
            // return redirect($redirectUrl, $redirect['http_status_code']);
            return redirect(url('/'));
        } catch (\Throwable $th) {
            return redirect(url('/'));
        }
    }
}
