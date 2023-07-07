<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeInterface;

/**
 * To fetch employee data from database
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class EmployeeRepository implements EmployeeInterface
{
    /**
     * Get all employees from database
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @return collection
     */
    public function getAllEmployees()
    {
        $employees = Employee::all();
        return $employees;
    }

    /**
     * Get all employees with pagination from database and according to the search conditions
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @param $perPage
     * @return collection
     */

    public function getAllEmployeesPaginate($perPage)
    {
        $employeeQuery = Employee::when(request()->employee_id != '',function($query){
            $employee_id = request()->get('employee_id');
            $query->where('employee_id',$employee_id);
        })->when(request()->employee_code!='',function($query){
            $employee_code = request()->get('employee_code');
            $query->where('employee_code','LIKE','%'.$employee_code.'%');
        })->when(request()->employee_name!='',function($query){
            $employee_name = request()->get('employee_name');
            $query->where('employee_name','LIKE',"%".$employee_name."%");
        })->when(request()->email_address!='',function($query){
            $email_address = request()->get('email_address');
            $query->where('email_address','LIKE','%'.$email_address.'%');
        });
        $count = $employeeQuery->get()->count();
        $employees = $employeeQuery->paginate($perPage)->withQueryString();
        return [
            'count' => $count,
            'employees' => $employees,
        ];
    }

    /**
     * Get a single employee
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @param $id
     * @return model
     */

    public function getEmployee($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }

    /**
     * Get all employees according to index page
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @return collection
     */

     public function getAllEmployeesDownload()
     {
         $employees = Employee::when(request()->employee_id != '',function($query){
             $employee_id = request()->get('employee_id');
             $query->where('employee_id',$employee_id);
         })->when(request()->employee_code!='',function($query){
             $employee_code = request()->get('employee_code');
             $query->where('employee_code','LIKE','%'.$employee_code.'%');
         })->when(request()->employee_name!='',function($query){
             $employee_name = request()->get('employee_name');
             $query->where('employee_name','LIKE',"%".$employee_name."%");
         })->when(request()->email_address!='',function($query){
             $email_address = request()->get('email_address');
             $query->where('email_address','LIKE','%'.$email_address.'%');
         })->offset((request()->page-1)*20)->limit(20)->get();
         return $employees;
     }

     /**
     * Get all employees before current employee'id
     * @author Swam Htet Aung
     *
     * @create date 06-07-2023
     * @return collection
     */

     public function getEmpCountBeforeCurrent($id)
     {
        return Employee::where('id','<',$id)->get()->count();
     }
}
