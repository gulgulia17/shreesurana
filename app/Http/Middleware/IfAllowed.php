<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IfAllowed
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
        $user = Auth::user();
        $permission = $request->path();
        if ($request->route()) {
            $permission = $request->route()->getName();
        }
        abort_if(!$user->can($permission), 403, 'No Permission');
        return $next($request);
    }
}
