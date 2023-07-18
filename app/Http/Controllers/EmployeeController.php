<?php

namespace App\Http\Controllers;

use App\DBTransactions\EmployeeUpload\DeleteEmployeeUpload;
use App\DBTransactions\EmployeeUpload\UpdateEmployeeUpload;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ExcelDownloadExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\EmployeeInterface;
use App\Http\Requests\StoreEmployeeRequest;
use App\Interfaces\EmployeeUploadInterface;
use App\DBTransactions\Employee\StoreEmployee;
use App\DBTransactions\Employee\ActiveEmployee;
use App\DBTransactions\Employee\DeleteEmployee;
use App\DBTransactions\Employee\InactiveEmployee;
use App\DBTransactions\Employee\UpdateEmployee;
use App\DBTransactions\EmployeeUpload\StoreEmployeeUpload;
use App\Http\Requests\UpdateEmployeeRequest;

/**
 * To handle employee CRUD
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class EmployeeController extends Controller
{
    protected $employeeInterface,$employeeUploadInterface;

    /**
     * Storing Interface variables and registering middlewares
     * @author Swam Htet Aung
     *
     * @create date 03-07-2023
     * @return void
     */
    public function __construct(EmployeeInterface $employeeInterface,EmployeeUploadInterface $employeeUploadInterface)
    {
        $this->employeeInterface = $employeeInterface;
        $this->employeeUploadInterface = $employeeUploadInterface;
        $this->middleware('emp.current',['only'=>['destroy','inactive','active']]);
        $this->middleware('emp.exists',['only'=>['show','update','edit','destroy','inactive','active','deletePhoto']]);
        $this->middleware('emp.inactive',['only'=>['update','edit','destroy','inactive','deletePhoto']]);
    }

    /**
     * Display listing of the employees.
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @return 'view'
     */
    public function index()
    {
        $employees = $this->employeeInterface->getAllEmployeesPaginate(20);

        if (request()->page > $employees['employees']->lastPage()) { #Checking if the page from request is greater than last page
            return redirect()->to(request()->fullUrlWithQuery(['page'=>$employees['employees']->lastPage()]))->with(['status'=>session('status')]);
        }

        return view('employee.index',$employees);
    }

    /**
     * Show the form for creating an employee.
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @return 'view'
     */
    public function create()
    {
        $employees = $this->employeeInterface->getAllEmployees();
        if (count($employees)==0) { #Checking if there are no employees in the database
            $default_emp_id = 10001;
        } else {
            $default_emp_id =  Employee::latest('employee_id')->value('employee_id') + 1;
        }
        return view('employee.create',compact('default_emp_id'));
    }

    /**
     * Store a newly created employee and employee's upload
     * @author Swam Htet Aung
     *
     * @create date 22-06-2023
     * @param  StoreEmployeeRequest $request
     * @return 'redirect'
     */
    public function store(StoreEmployeeRequest $request)
    {
        $uploadEmployee = new StoreEmployee($request);
        $uploadEmployee = $uploadEmployee->executeProcess();

        if ($request->hasFile('photo')) { #Checking if the user uploaded a photo
            $photo = $request->file('photo');
            $photoExtension = $photo->getClientOriginalExtension();
            $photoSize = $photo->getSize();
            $fileName = $request->employee_id.time().'.'.$photoExtension;
            $fileSave = $photo->move(public_path('register'),$fileName);

            $file = [
                'path'=>'register/'.$fileName,
                'size'=>$photoSize,
                'extension'=>$photoExtension
            ];
            $uploadEmployeeFile = new StoreEmployeeUpload($request,$file);
            $uploadEmployeeFile = $uploadEmployeeFile->executeProcess();
            if ($uploadEmployee && $uploadEmployeeFile) { #Checking if storing employee and employee's uploaded succeeded
                return redirect()->route('employees.index')->with(['status'=>'Successfully registered']);
            } else {
                return redirect()->route('employees.create',['register_type' => 1])->with(['error'=>'Register Failed']);
            }
        }

        if ($uploadEmployee) { #Checking if storing employee succeeded
            return redirect()->route('employees.index')->with(['status'=>'Successfully registered']);
        } else {
            return redirect()->route('employees.create',['register_type' => 1])->with(['error'=>'Register Failed']);
        }
    }

    /**
     * Display the specified employee info.
     * @author Swam Htet Aung
     *
     * @create date 22-06-2023
     * @param  $id
     * @return 'view'
     */
    public function show($id)
    {
        if (session('employee')->id == $id) { #Checking if the employee is currently logged in user
            session()->put("prev_url_for_show_$id",route('employees.index'));
        } else {
            session()->put("prev_url_for_show_$id",url()->previous());
        }

        $employee = $this->employeeInterface->getEmployee($id);
        $employeePhoto = $this->employeeUploadInterface->getEmployeeUpload($employee->employee_id);

        return view('employee.show',['employee'=>$employee,'employeePhoto'=>$employeePhoto->file_path ?? 'https://i.pinimg.com/564x/16/3e/39/163e39beaa36d1f9a061b0f0c5669750.jpg']);
    }

    /**
     * Show the form for editing the specified employee.
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @param  $id
     * @return 'view'
     */
    public function edit($id)
    {
        if (url()->previous() !== route('employees.edit',$id)) { #Checking if current page url is the same as previous url
            session()->put("prev_url_$id",url()->previous());
        }
        $employee = $this->employeeInterface->getEmployee($id);

        $employeePhoto = $this->employeeUploadInterface->getEmployeeUpload($employee->employee_id);

        return view('employee.edit',['employee'=>$employee,'employeePhoto'=>$employeePhoto->file_path ?? 'https://i.pinimg.com/564x/16/3e/39/163e39beaa36d1f9a061b0f0c5669750.jpg']);
    }

    /**
     * Update the specified employee's information.
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @param  Request $request
     * @param  $id
     * @return 'redirect'
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $updateEmployee = new UpdateEmployee($request,$id);
        $updateEmployee = $updateEmployee->executeProcess();
        $prevUrl = session("prev_url_$id");
        if ($request->hasFile('photo')) { #Checking if the user uploaded a photo
            $photo = $request->file('photo');
            $photoExtension = $photo->getClientOriginalExtension();
            $photoSize = $photo->getSize();
            $fileName = $request->employee_id.time().'.'.$photoExtension;
            $fileSave = $photo->move(public_path('register'),$fileName);

            $file = [
                'path'=>'register/'.$fileName,
                'size'=>$photoSize,
                'extension'=>$photoExtension
            ];

            $isPhotoExists = $this->employeeUploadInterface->getEmployeeUpload($request->employee_id);

            if ($isPhotoExists) { #Checking if the updated user already has a photo
                $updateEmployeeFile = new UpdateEmployeeUpload($request,$file);
                $fileUpload = $updateEmployeeFile->executeProcess();
            }

            if (!$isPhotoExists) { #Checking if the updated user don't have a photo
                $uploadEmployeeFile = new StoreEmployeeUpload($request,$file);
                $fileUpload = $uploadEmployeeFile->executeProcess();
            }

            if ($updateEmployee && $fileUpload) { #Checking if storing employee and employee's uploaded succeeded
                session()->forget("prev_url_$id");
                return redirect()->to($prevUrl)->with(['status'=>'Successfully updated']);
            } else {
                return redirect()->back()->with(['error'=>'Update Failed']);
            }
        }

        if ($updateEmployee) { #Checking if storing employee succeeded
            session()->forget("prev_url_$id");
            return redirect()->to($prevUrl)->with(['status'=>'Successfully updated']);
        } else {
            return redirect()->back()->with(['error'=>'Update Failed']);
        }
    }

    /**
     * Delete the specified employee.
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @param  $id
     * @return 'redirect'
     */
    public function destroy($id)
    {
        $deleteEmployee = new DeleteEmployee($id);
        $deleteEmployee = $deleteEmployee->executeProcess();

        if ($deleteEmployee) { #Checking if deleting the employee succeeded
            return redirect()->back()->with(['status'=>'Successfully deleted']);
        } else {
            return redirect()->back()->with(['error'=>'Delete Failed']);
        }
    }

    /**
     * Inactive the specified employee
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @param  $id
     * @return 'redirect'
     */
    public function inactive($id)
    {
        $inactiveEmployee = new InactiveEmployee($id);
        $inactiveEmployee = $inactiveEmployee->executeProcess();
        if ($inactiveEmployee) { #Checking if inactive process is successful
            return redirect()->back()->with(['status'=>'Successfully inactived user']);
        } else {
            return redirect()->back()->with(['error'=>'Inactive failed']);
        }
    }

    /**
     * Active the specified employee
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @param  $id
     * @return 'redirect'
     */
    public function active($id)
    {
        $employee = $this->employeeInterface->getEmployee($id);

        if ($employee->deleted_at == null) { #Checking if the employee is already active
            return redirect()->back()->with(['error'=>'This employee is already active']);
        }

        $activeEmployee = new ActiveEmployee($id);
        $activeEmployee = $activeEmployee->executeProcess();
        if ($activeEmployee) { #Checking if active process is successful
            return redirect()->back()->with(['status'=>'Successfully actived user']);
        } else {
            return redirect()->back()->with(['error'=>'Active failed']);
        }
    }

    /**
     * To delete photo of employee
     * @author Swam Htet Aung
     *
     * @create date 17-07-2023
     * @param  $id
     * @return 'redirect'
     */
    public function deletePhoto($id)
    {
        $employee = $this->employeeInterface->getEmployee($id);
        $employeeUpload = $this->employeeUploadInterface->getEmployeeUpload($employee->employee_id);

        if (!$employeeUpload) { #Checking if the employee is doesn't have a photo
            return redirect()->back()->with(['error'=>'The employee does not have a photo']);
        }

        $deleteEmployeeUpload = new DeleteEmployeeUpload($employee->employee_id);
        $deleteEmployeeUpload = $deleteEmployeeUpload->executeProcess();
        if ($deleteEmployeeUpload) { #Checking if active process is successful
            return redirect()->back()->with(['status'=>'Successfully deleted photo']);
        } else {
            return redirect()->back()->with(['error'=>'Deleting photo failed']);
        }
    }

    /**
     * Download excel or pdf with search conditions
     * @author Swam Htet Aung
     *
     * @create date 26-06-2023
     * @param  Request $request
     * @return mixed
     */
    public function download(Request $request)
    {
        $employees = $this->employeeInterface->getAllEmployeesDownload();

        if ($request->type == 1) { #Checking if the download type is pdf
            $pdf = Pdf::loadView('download.pdfDownload', ['employees'=>$employees]);
            return $pdf->download('EmployeeList.pdf');
        }

        if ($request->type == 2) { #Checking if the download type is excel
            return Excel::download(new ExcelDownloadExport($employees), 'EmployeeList.xlsx');
        }

        return redirect()->route('employees.index');
    }
}
