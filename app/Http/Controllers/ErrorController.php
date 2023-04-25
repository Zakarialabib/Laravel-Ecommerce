<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Enums\RedirectionStatus;
use Throwable;

class ErrorController extends Controller
{
    public function notFound(Request $request): RedirectResponse
    {
        try {
            // Check if the unfound URL already exists in the database
            $redirect = Redirect::where('old_url', $request->url())->first();

            if ($redirect) {
                // If it does, redirect to the new URL with status code
                return redirect($redirect->new_url, $redirect->http_status_code);
            }

            // If not, store the unfound URL in the database and redirect to the app URL with status code
            $redirect = Redirect::create([
                'old_url'          => $request->url(),
                'new_url'          => url('/'),
                'http_status_code' => RedirectionStatus::MOVED_PERMANENTLY,
            ]);

            return redirect($redirect->new_url, $redirect->http_status_code);
        } catch (Throwable $th) {
            return redirect(url('/'));
        }
    }
}
