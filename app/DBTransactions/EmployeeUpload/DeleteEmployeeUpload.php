<?php

namespace App\DBTransactions\EmployeeUpload;

use App\Classes\DBTransaction;
use App\Models\EmployeeUpload;

/**
 * To handle deleting employee's photo
 *
 * @author Swam Htet Aung
 *
 * @create date 17-07-2023
 *
 */
class DeleteEmployeeUpload extends DBTransaction
{
    private $id;

    /**
     * Storing employee photo id
     * @author Swam Htet Aung
     *
     * @create date 17-07-2023
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Deleting employee photo
     *
     * @author Swam Htet Aung
     * @create date 17-08-2023
     * @return array
     *
    */
    public function process()
    {
            $id = $this->id;
            $employeeUpload = EmployeeUpload::where('employee_id',$id)->first();
            unlink($employeeUpload->file_path);

            $employeeUpload = $employeeUpload->delete();

            if ($employeeUpload) {  #Checking if updating the employee upload information succeeded
                if (session('employee')->employee_id == $id) { #Checking if logged in employee is the same as updated employee
                    session()->put('employee_photo','https://i.pinimg.com/564x/16/3e/39/163e39beaa36d1f9a061b0f0c5669750.jpg');
                }
                return ['status' =>true,'error' =>''];
            } else {
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
