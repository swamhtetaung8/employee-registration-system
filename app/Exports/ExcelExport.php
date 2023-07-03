<?php

namespace App\Exports;

use App\Exports\Sheets\EmployeeRegistrationSheet;
use App\Exports\Sheets\GenderSheet;
use App\Exports\Sheets\MaritalStatusSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * To handle excel export sheet
 *
 * @author Swam Htet Aung
 *
 * @create date 23-06-2023
 *
 */
class   ExcelExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * Excel export
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @return array
     *
    */
    public function sheets():array
    {
        $sheets = [];

        $sheets[] = new EmployeeRegistrationSheet;
        $sheets[] = new GenderSheet;
        $sheets[] = new MaritalStatusSheet;

        return $sheets;
    }
}
