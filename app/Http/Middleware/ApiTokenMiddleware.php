<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ApiTokenMiddleware
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
        if ($token = $request->header('Authorization', $request->input('token'))) {
            $user = User::where('api_token', $token)->first();
            if ($user) {
                \Auth::setUser($user);
                return $next($request);
            }
        }

        return response(['error' => 'Unauthorized'], 401);
    }
}
