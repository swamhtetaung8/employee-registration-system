<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;

/**
 * To handle if the current employee is inactive
 *
 * @author Swam Htet Aung
 *
 * @create date 07-07-2023
 *
 */
class CheckInactiveEmployeeMiddleware
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
        $employee = Employee::find($request->employee);
        if ($employee->deleted_at !== null) { #Checking if current employee is inactive
            if (request()->method() == 'PUT') {  #Checking if request method is PUT
                return redirect()->to(session("prev_url_$request->employee"))->with(['error'=>'This employee is currently inactive.']);
            };
            return redirect()->back()->with(['error'=>'This employee is currently inactive.']);
        }
        return $next($request);
    }
}
