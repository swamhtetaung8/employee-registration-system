<?php

namespace App\Http\Middleware;

use Closure;

/**
 * To handle if the employee is currently loggedIn
 *
 * @author Swam Htet Aung
 *
 * @create date 07-07-2023
 *
 */
class CheckCureentLoggedInUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @author Swam Htet Aung
     *
     * @create date 07-07-2023
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('employee')->id == $request->employee) { #Checking if the request id is the id of currently logged in user
            return redirect()->back()->with(['error'=>'This user is currently logged in']);
        }
        return $next($request);
    }
}
