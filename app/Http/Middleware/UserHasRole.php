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
    public function handle($request, Closure $next, $role)
    {
        if($request->user() != null ){
            if (! $request->user()->hasRole($role)) {
                abort(403, 'No tienes autorización para realizar esta acción');
            }
            return $next($request);
        }else {
            return redirect()->route('login');
        }
    }
}
