<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

class CheckApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()->status) {
            return redirect()->route('auth.approval');
        }

        return $next($request);
    }
}
