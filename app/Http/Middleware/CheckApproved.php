<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->status) {
            return redirect()->route('auth.approval');
        }

        return $next($request);
    }
}
