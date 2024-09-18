<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->email === 'ardiansyah.putra@uts.ac.id' || $request->user()->email === 'erwin.mardinata@uts.ac.id')
            return $next($request);
        abort(401);
    }
}
