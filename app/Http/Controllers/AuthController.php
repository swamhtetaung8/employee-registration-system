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
        $request->validate([
            'employee_id'=>'integer'
        ],[
            'employee_id.integer'=>'Invalid Credentials'
        ]);

        $employee = Employee::where('employee_id', $request->employee_id)->first();

        if ($employee) { #Checking if the employee id exists in database
            if (!Hash::check($request->password, $employee->password)) {
                #To check if the request password matches with the password of the employee
                return redirect()->route('auth.login')->withErrors(['employee_id'=>'Invalid Credentials']);
            }

            session()->put('employee',$employee);
            if(isset($employee->upload->file_path)){
                session()->put('employee_photo',asset($employee->upload->file_path));
            }else{
                session()->put('employee_photo','https://i.pinimg.com/564x/16/3e/39/163e39beaa36d1f9a061b0f0c5669750.jpg');
            }

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
        session()->forget('employee_photo');
        session()->forget('prev_url');
        return redirect()->route('auth.login');
    }
}
