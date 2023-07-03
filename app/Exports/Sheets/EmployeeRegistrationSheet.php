<?php

namespace App\Exports\Sheets;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use PhpOffice\PhpSpreadsheet\Style\Color;

/**
 * Employee Registration Sheet Design
 *
 * @author Swam Htet Aung
 *
 * @create date 23-06-2023
 *
 */
class EmployeeRegistrationSheet implements WithTitle,FromView,WithStyles,WithEvents,WithHeadingRow
{
    use RegistersEventListeners;

    /**
     * Define the title of the sheet
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @return string
     *
    */
    public function title(): string
    {
        return 'Employee Registration';
    }

    /**
     * Define the layout of the sheet
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @return view
     *
    */
    public function view():View
    {
        return view('excelExport.employeeRegistration');
    }

    /**
     * Define the styling of the sheet
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @return void
     *
    */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'align' =>'center'
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '9CCEFF',
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getRowDimension(1)->setRowHeight(25);

        $sheet->getStyle('A1')->getFont()->getColor()->setRGB(Color::COLOR_RED);
        $sheet->getStyle('B1')->getFont()->getColor()->setRGB(Color::COLOR_RED);
        $sheet->getStyle('C1')->getFont()->getColor()->setRGB(Color::COLOR_RED);
        $sheet->getStyle('D1')->getFont()->getColor()->setRGB(Color::COLOR_RED);
        $sheet->getStyle('E1')->getFont()->getColor()->setRGB(Color::COLOR_RED);
        $sheet->getStyle('G1')->getFont()->getColor()->setRGB(Color::COLOR_RED);

        $sheet->getStyle('A1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('B1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('C1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('D1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('E1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('F1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('G1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('H1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
        $sheet->getStyle('I1')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
}
