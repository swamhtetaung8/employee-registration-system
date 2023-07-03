<?php

namespace App\Imports;

use Exception;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * To handle data imported from excel
 *
 * @author Swam Htet Aung
 *
 * @create date 23-06-2023
 *
 */
class EmployeeImport implements ToCollection,WithHeadingRow
{
    public $errors,$rowError,$importSuccess,$emailError;

    /**
     * Storing data from Excel file
     *
     * @author Swam Htet Aung
     * @create date 23-06-2023
     * @param Collection $rows
     * @return void
     *
    */
    public function collection(Collection $rows)
    {
        $data = [];
        if (count($rows)>100) { #Checking if there are more than 100 rows in Excel
            $this->rowError = 'Do not allow more than 100 rows.';
        } else {
            foreach ($rows as $index=>$row) { #To add rows from excel into data array

                $current_emp_id =  (Employee::latest('id')->value('id') + 10001 )+ $index;

                $validator = Validator::make($row->toArray(),[
                    'employee_code' => ['required'],
                    'employee_name' => ['required'],
                    'nrc_number' => ['required','regex:/^[^!@#$%^&*_+=~`[\]{}|:;"<>,.?\\\]+$/'],
                    'email_address' => 'required|email|unique:employees,email_address',
                    'password' => 'required|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{4,8}$/',
                    'date_of_birth' => 'required|numeric',
                    'gender'=>'nullable|numeric|in:1,2',
                    'marital_status'=>'nullable|numeric|in:1,2,3'
                ],[
                    'date_of_birth.numeric'=>'Date must be a valid date format',
                    'password.regex'=>'Password must be contained capital letter, small letter, special characters and number, minimum length is 4 and maximum length is 8.',
                    'gender.in'=>'Gender must be 1 or 2.',
                    'marital_status.in'=>'Marital status must be 1 or 2 or 3.',
                ]);

                if (isset($row['employee_code']) && isset($row['employee_name']) && isset($row['nrc_number']) && isset($row['email_address']) && isset($row['password']) && isset($row['date_of_birth'])) {
                    #Checking if the data has reached
                    if ($validator->fails()) { #Checking if the validation failed
                        $this->errors[] = [
                            'row'=>($index+2),
                            'errors'=>$validator->errors()
                        ];
                    }
                }

                if (isset($row['employee_code']) && isset($row['employee_name']) && isset($row['nrc_number']) && isset($row['email_address']) && isset($row['password']) && isset($row['date_of_birth']) && !$validator->fails() ) {
                    #Checking if the data has reached and validation succeeded
                    $employee_id = $current_emp_id;
                    $employee_code = $row['employee_code'];
                    $employee_name = $row['employee_name'];
                    $nrc_number = $row['nrc_number'];
                    $email_address = $row['email_address'];
                    $password = Hash::make($row['password']);
                    $date_of_birth = Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d');
                    $gender = $row['gender']??null;
                    $marital_status = $row['marital_status']??null;
                    $address = $row['address']??null;

                    $data[] = [
                        'employee_id'=>$employee_id,
                        'employee_code'=>$employee_code,
                        'employee_name'=>$employee_name,
                        'nrc_number'=>$nrc_number,
                        'email_address'=>$email_address,
                        'password'=>$password,
                        'date_of_birth'=>$date_of_birth,
                        'gender'=>$gender,
                        'marital_status'=>$marital_status,
                        'address'=>$address,
                        'deleted_at'=>null,
                        'created_at'=>now(),
                        'updated_at'=>now(),
                    ];
                }
            }

            try{
                if ($this->errors==null && $data!=[]) { #Checking if data is not empty
                    Employee::insert($data);
                    $this->importSuccess = true;
                }
            } catch (Exception $e) {
                $this->emailError = true;
            }
        }

    }
}
