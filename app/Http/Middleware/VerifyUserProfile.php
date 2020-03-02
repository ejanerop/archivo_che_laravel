<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUserProfile
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
        if($request->user() != null ){
            if ($request->user()->id != $request->route('id')) {
                abort(403, 'No tienes autorización para realizar esta acción');
            }
            return $next($request);
        }else {
            return redirect()->route('login');
        }
    }
}
