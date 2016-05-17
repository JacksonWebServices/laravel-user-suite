<?php

namespace App\Http\Middleware;

use Closure;

class RouteAccessChecker
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
        // TODO: Refine this before pushing live
//        if ($request->user()->hasRole("admin")) {
//            return $next($request);
//        }

//        $route = \Request::route()->getName();
//        if (\Gate::denies($route)) {
//            return back()
//                ->with('error_message', "Sorry, page cannot be accessed!");
//        }

        return $next($request);
    }
}
