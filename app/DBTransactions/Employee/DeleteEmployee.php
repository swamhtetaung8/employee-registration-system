<?php

namespace App\DBTransactions\Employee;

use App\Classes\DBTransaction;
use App\Models\Employee;
use App\Models\EmployeeUpload;

/**
 * To handle deleteing an employee
 *
 * @author Swam Htet Aung
 *
 * @create date 27-06-2023
 *
 */
class DeleteEmployee extends DBTransaction
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Deleting the employee
     *
     * @author Swam Htet Aung
     *
     * @create date 27-06-2023
     *
     */
    public function process()
    {
        $employee = Employee::find($this->id);
        $employeeUpload = EmployeeUpload::where('employee_id',$employee->employee_id)->first();
        $employee = $employee->delete();
        if ($employeeUpload) { #Checking if the deleted employee has a photo
            unlink($employeeUpload->file_path);
        }

        if ($employee) { #Checking if making the employee active succeeded
            return ['status' =>true,'error' =>''];
        } else {
            return ['status' =>false,'error' =>'Failed'];
        }
    }
}
