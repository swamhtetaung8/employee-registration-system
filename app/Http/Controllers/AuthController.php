<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

/**
 * To handle authentication of employees
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class AuthController extends Controller
{

    /**
     * Returns login view
     *
     * @author Swam Htet Aung
     * @create date 21-06-2023
     * @return view
     *
    */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     *
     * @author Swam Htet Aung
     * @create date 21-06-2023
     * @param LoginRequest $request
     * @return redirect
     *
    */
    public function check(LoginRequest $request)
    {
        $employee = Employee::where('employee_id', $request->employee_id)->first();

        if($employee){
            if (!Hash::check($request->password, $employee->password)) {
                #To check if the request password matches with the password of the employee
                return redirect()->route('auth.login')->withErrors(['employee_id'=>'Invalid Credentials']);
            }

            session()->put('employee',$employee);

            return redirect()->route('employees.index');
        }
        return redirect()->route('auth.login')->withErrors(['employee_id'=>'Invalid Credentials']);
    }

    /**
     * Handle logout
     *
     * @author Swam Htet Aung
     * @create date 21-06-2023
     * @return redirect
     *
    */

    public function logout()
    {
        session()->forget('employee');
        return redirect()->route('auth.login');
    }
}
