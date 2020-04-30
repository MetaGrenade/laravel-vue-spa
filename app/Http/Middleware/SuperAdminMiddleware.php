<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class SuperAdminMiddleware
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

        /*if ($request->user() && $request->user()->role !== 'super-admin'){
            return response()->json(['success' => false, 'message' => "Access Denied! You do not have permission to perform this action!"], 403);
        }
        elseif (!$request->user()) {
            return response()->json(['success' => false, 'message' => "Access Denied! You do not have permission to perform this action!"], 403);
        }*/

        return $next($request);
    }
}
