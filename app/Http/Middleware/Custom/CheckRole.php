<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role = false)
    {
        // if (!$request->user()->hasRole($role)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        $check = $request->user()->sdm_name ? 'sdm' : 'student';
        if ($check !== $role) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
