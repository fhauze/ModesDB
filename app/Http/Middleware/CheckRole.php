<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
