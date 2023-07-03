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
                return ['status' =>true,'error' =>''];
            }else{
                return ['status' =>false,'error' =>'Failed'];
            }
    }
}
