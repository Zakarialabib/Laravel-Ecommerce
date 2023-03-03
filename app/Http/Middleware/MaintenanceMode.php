<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Generalsetting;
use Closure;

class MaintenanceMode
{
    public function handle($request, Closure $next)
    {
        $gs = Generalsetting::find(1);

        if ($gs->is_maintain === 1) {
            return redirect()->route('front-maintenance');
        }

        return $next($request);
    }
}
