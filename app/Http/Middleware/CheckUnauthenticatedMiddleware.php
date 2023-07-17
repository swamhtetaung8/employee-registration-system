<?php

namespace App\Http\Middleware;

use Closure;

/**
 * To handle if the current user is unauthenticated
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class CheckUnauthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     * @author Swam Htet Aung
     * @create date 21-06-2023
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('employee')) { #Checking if the user is already logged in
            return redirect()->route('employees.index');
        }
        return $next($request);
    }
}
