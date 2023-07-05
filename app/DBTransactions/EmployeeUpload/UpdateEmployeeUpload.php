<?php

namespace App\DBTransactions\EmployeeUpload;

use App\Classes\DBTransaction;
use App\Models\EmployeeUpload;

/**
 * To handle updating employee upload infos
 *
 * @author Swam Htet Aung
 *
 * @create date 28-06-2023
 *
 */
class UpdateEmployeeUpload extends DBTransaction
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
     * Updating employee upload info
     *
     * @author Swam Htet Aung
     * @create date 28-06-2023
     * @return array
     *
    */
    public function process()
    {
            $request = $this->request;
            $employeeUpload = EmployeeUpload::where('employee_id',$request->employee_id)->first();
            unlink($employeeUpload->file_path);
            $file = $this->file;
            $employeeUpload->file_path = $file['path'];
            $employeeUpload->file_size = (int)$file['size'];
            $employeeUpload->file_extension = $file['extension'];

            $employeeUpload = $employeeUpload->update();

            if ($employeeUpload) {  #Checking if updating the employee upload information succeeded
                if (session('employee')->employee_id == $request->employee_id) { #Checking if logged in employee is the same as updated employee
                    session()->put('employee_photo',asset($file['path']));
                }
                return ['status' =>true,'error' =>''];
            }else{
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
