<?php

namespace App\DBTransactions\Employee;

use App\Classes\DBTransaction;
use App\Models\Employee;

/**
 * To handle updating employee infos
 *
 * @author Swam Htet Aung
 *
 * @create date 28-06-2023
 *
 */
class UpdateEmployee extends DBTransaction
{
    private $request,$id;

    public function __construct($request,$id)
    {
        $this->request = $request;
        $this->id = $id;
    }

    /**
     * Updating employee infos
     *
     * @author Swam Htet Aung
     *
     * @create date 28-06-2023
     *
     */

    public function process()
    {
            $employee = Employee::find($this->id);
            $request = $this->request;
            $employee->employee_code = $request->employee_code;
            $employee->employee_name = $request->employee_name;
            $employee->nrc_number = $request->nrc_number;
            $employee->email_address = $request->email_address;
            $employee->date_of_birth = $request->date_of_birth;

            if (isset($request->gender)) { #Checking if the user submitted a gender field
                $employee->gender = (int)$request->gender;
            }
            if ($request->marital_status!=='none') { #Checking if the user submitted a marital_status field
                $employee->marital_status = (int)$request->marital_status;
            }
            if ($request->marital_status=='none') {
                $employee->marital_status = null;
            }
            if ($request->address!==null) { #Checking if the user submitted an address field
                $employee->address = $request->address;
            }

            $employee = $employee->update();

            if ($employee) { #Checking if updating the employee information succeeded
                return ['status' =>true,'error' =>''];
            }else{
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
