<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
class RoleMiddleware
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
        if($request->input('emial')){
            $user = User::where('email',$request->input('email'))->first();

            print_r($user);
        }
        return $next($request);
    }
}
