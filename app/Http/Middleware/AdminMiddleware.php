<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AdminMiddleware
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
        if ($request->user()){
            if($request->user()->role !== 'admin' && $request->user()->role !== 'super-admin'){
                return response()->json(['message' => "Access Denied! You do not have permission to perform this action!"], 403);
            }
        }
        else {
            return response()->json(['message' => "Access Denied! You must login to perform this action!"], 403);
        }

        return $next($request);
    }
}
