<?php

namespace App\DBTransactions\Employee;

use App\Classes\DBTransaction;
use App\Models\Employee;

/**
 * To handle making an employee active
 *
 * @author Swam Htet Aung
 *
 * @create date 26-06-2023
 *
 */
class ActiveEmployee extends DBTransaction
{
    private $id;

    /**
     * Storing employee id
     * @author Swam Htet Aung
     *
     * @create date 03-07-2023
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Making the specified employee active
     *
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     *
     */

    public function process()
    {
            $employee = Employee::find($this->id);
            $employee->deleted_at = null;
            $employee = $employee->update();
            if ($employee) { #Checking if making the employee active succeeded
                return ['status' =>true,'error' =>''];
            } else {
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
