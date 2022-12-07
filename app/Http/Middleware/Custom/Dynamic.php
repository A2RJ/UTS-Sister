<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Laravel\Sanctum\Exceptions\MissingAbilityException;

class Dynamic
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
        /**
         * add list ability in database by route uri
         * if found auth, then check user auth
         * * if unauthenticated throw new AuthenticationException();
         * * else check user and routes has same ability $next($request) 
         * * or not throw new MissingAbilityException($ability);
         * */

        // echo json_encode($request->route()->uri()); // routes name
        // $abilityFromDb = [];
        // foreach ($abilityFromDb as $ability) {
        //     if (!$request->user() || !$request->user()->currentAccessToken()) {
        //         throw new AuthenticationException();
        //     }
        //     if (!$request->user()->tokenCan($ability)) {
        //         throw new MissingAbilityException($ability);
        //     }
        // }

        return $next($request);
    }
}
