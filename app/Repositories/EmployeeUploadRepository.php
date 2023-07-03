<?php

namespace App\Repositories;

use App\Models\EmployeeUpload;
use App\Interfaces\EmployeeUploadInterface;

/**
 * To fetch employee upload data from database
 *
 * @author Swam Htet Aung
 *
 * @create date 22-06-2023
 *
 */
class EmployeeUploadRepository implements EmployeeUploadInterface
{
    /**
     * Get a single employee photo info
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @param $id
     * @return model
     */
    public function getEmployeeUpload($id)
    {
        $upload = EmployeeUpload::where('employee_id',$id)->first();
        return $upload;
    }
}
