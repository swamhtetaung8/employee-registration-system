<?php

namespace App\Http\Middleware;

use Closure;

/**
 * To handle if the current user is authenticated
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class CheckAuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @author Swam Htet Aung
     * @create date 21-06-2023
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has('employee')){
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
