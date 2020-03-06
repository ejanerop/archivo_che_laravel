<?php

namespace App\Http\Middleware;

use Closure;

class UserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if($request->user() != null ){
            $hasRole = false;
            foreach ($roles as $role) {
                if ($request->user()->hasRole($role)) {
                    $hasRole = true;
                }
            }
            if ($hasRole) {
                return $next($request);
            } else {
                abort(403, 'No tienes autorización para realizar esta acción');
            }
        }else {
            return redirect()->route('login');
        }
    }
}
