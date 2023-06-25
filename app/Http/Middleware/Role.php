<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;


class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user && is_array($roles)) {
            foreach ($roles as $role) {
                if ($user->role == $role) {
                    return $next($request);
                }
            }
        }

        return abort(401, 'Unauthorized');
    }
}

