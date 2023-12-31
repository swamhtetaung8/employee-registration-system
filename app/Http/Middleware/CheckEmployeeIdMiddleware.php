<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;

/**
 * To handle if the employee is existed in database
 *
 * @author Swam Htet Aung
 *
 * @create date 04-07-2023
 *
 */
class CheckEmployeeIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @author Swam Htet Aung
     * @create date 04-07-2023
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $id
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $employee = Employee::find($request->employee);
        if (!$employee) { #Checking if employee with specified id exists
            if (request()->method() == 'PUT') { #Checking if request method is PUT
                return redirect()->to(session("prev_url_$request->employee"))->with(['error'=>'Employee does not exist']);
            };
            return redirect()->back()->with(['error'=>'Employee does not exist']);
        }
        return $next($request);
    }
}
