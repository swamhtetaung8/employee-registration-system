<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Http\Requests\ExcelImportRequest;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * To handle Excel export and data import from Excel
 *
 * @author Swam Htet Aung
 *
 * @create date 23-06-2023
 *
 */
class ExcelController extends Controller
{
    /**
     * Export excel format
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @return 'Excel'
     *
    */
    public function export()
    {
        return Excel::download(new ExcelExport, 'EmployeeRegistration.xlsx');
    }

    /**
     * Import data from excel
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @param ExcelImportRequest $request
     * @return 'redirect'
     *
    */
    public function import(ExcelImportRequest $request)
    {
        $import = new EmployeeImport;
        Excel::import($import,$request->file('excel'));
        if (!empty($import->errors)) { #Checking if validation errors failed
            return redirect()->route('employees.create',['register_type'=>2])->with(['excelError'=>$import->errors]);
        }
        if (!empty($import->rowError)) { #Checking if there are more than 100 rows in Excel
            return redirect()->route('employees.create',['register_type'=>2])->with(['error'=>$import->rowError]);
        }
        if ($import->emailError === true) { #Checking if there are more than 100 rows in Excel
            return redirect()->route('employees.create',['register_type'=>2])->with(['error'=>'Email does not allow duplicate email address.']);
        }
        if ($import->importSuccess === true) { #Checking if data insertion is successful
            return redirect()->route('employees.index')->with(['status'=>'Successfully Registered from Excel']);
        }else{
            return redirect()->route('employees.create',['register_type'=>2])->with(['error'=>'Registeration failed, Invalid excel format']);
        }

    }
}
