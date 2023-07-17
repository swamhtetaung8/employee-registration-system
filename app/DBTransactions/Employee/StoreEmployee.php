<?php

namespace App\DBTransactions\Employee;

use App\Classes\DBTransaction;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

/**
 * To handle storing employee infos
 *
 * @author Swam Htet Aung
 *
 * @create date 22-06-2023
 *
 */
class StoreEmployee extends DBTransaction
{
    private $request;

    /**
     * Storing employee request information
     * @author Swam Htet Aung
     *
     * @create date 03-07-2023
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Storing employee infos
     *
     * @author Swam Htet Aung
     *
     * @create date 22-06-2023
     *
     */

    public function process()
    {
            $employee = new Employee;
            $request = $this->request;
            $employee->employee_id = (int)$request->employee_id;
            $employee->employee_code = $request->employee_code;
            $employee->employee_name = $request->employee_name;
            $employee->nrc_number = $request->nrc_number;
            $employee->password = Hash::make($request->password);
            $employee->email_address = $request->email_address;
            $employee->date_of_birth = $request->date_of_birth;

            if (isset($request->gender)) { #Checking if the user submitted a gender field
                $employee->gender = (int)$request->gender;
            }
            if ($request->marital_status!=='none') { #Checking if the user submitted a marital_status field
                $employee->marital_status = (int)$request->marital_status;
            }
            if ($request->address!==null) { #Checking if the user submitted an address field
                $employee->address = $request->address;
            }

            $employee = $employee->save();

            if ($employee) { #Checking if storing the employee information succeeded
                return ['status' =>true,'error' =>''];
            } else {
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
