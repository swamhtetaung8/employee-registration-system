<?php

namespace App\DBTransactions\EmployeeUpload;

use App\Classes\DBTransaction;
use App\Models\EmployeeUpload;

/**
 * To handle storing employee upload infos
 *
 * @author Swam Htet Aung
 *
 * @create date 22-06-2023
 *
 */
class StoreEmployeeUpload extends DBTransaction
{
    private $request,$file;

    /**
     * Storing employee request information and upload file information
     * @author Swam Htet Aung
     *
     * @create date 03-07-2023
     * @return void
     */
    public function __construct($request,$file)
    {
        $this->request = $request;
        $this->file = $file;
    }

    /**
     * Storing employee upload info
     *
     * @author Swam Htet Aung
     * @create date 22-06-2023
     * @return array
     *
    */
    public function process()
    {
            $employeeUpload = new EmployeeUpload;
            $request = $this->request;
            $file = $this->file;
            $employeeUpload->employee_id = $request->employee_id;
            $employeeUpload->file_path = $file['path'];
            $employeeUpload->file_size = (int)$file['size'];
            $employeeUpload->file_extension = $file['extension'];

            $employeeUpload = $employeeUpload->save();

            if ($employeeUpload) {  #Checking if storing the employee upload information succeeded
                if (session('employee')->employee_id == $request->employee_id) { #Checking if logged in employee is the same as updated employee
                    session()->put('employee_photo',asset($file['path']));
                }
                return ['status' =>true,'error' =>''];
            }else{
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
