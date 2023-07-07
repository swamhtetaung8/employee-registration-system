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
            return redirect()->route('employees.index')->with(['error'=>'This employee is currently inactive.']);
        }
        return $next($request);
    }
}
