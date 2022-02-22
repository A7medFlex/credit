<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForceNonHttpsToHttp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(\Request::secure() &&
            !in_array('https', request()->route()->middleware()))
            return \Redirect::to(\Request::getRequestUri(), 302, array(), false);

        return $next($request);
    }
}
