<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <style>
        table{
            margin:10px auto
        }
        table,th,td{
            border:1px solid black;
            border-collapse: collapse;
        }
        th,td{
            padding:5px
        }
        *{
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8px
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="width:10px;" >#</th>
                <th style="width:15px;" >Employee ID</th>
                <th style="width:15px;" >Employee Code</th>
                <th style="width:50px;" >Employee Name</th>
                <th style="width:30px;" >NRC Number</th>
                <th style="width:30px;" >Email</th>
                <th style="width:20px;" >Gender</th>
                <th>Date of birth</th>
                <th style="width:20px;" >Marital Status</th>
                <th style="width:100px; ">Address</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $index=>$employee)
                <tr>
                    <td>{{ ($index+1)}}</td>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->employee_code }}</td>
                    <td>{{ $employee->employee_name }}</td>
                    <td>{{ $employee->nrc_number }}</td>
                    <td>{{ $employee->email_address }}</td>
                    <td>
                        @if ($employee->gender == 1)
                            Male
                        @endif
                        @if ($employee->gender == 2)
                            Female
                        @endif
                        @if ($employee->gender !== 1 && $employee->gender !==2)
                            Not selected
                        @endif
                    </td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>
                        @if ($employee->marital_status==1)
                            Single
                        @endif
                        @if ($employee->marital_status==2)
                            Married
                        @endif
                        @if ($employee->marital_status==3)
                            Divorced
                        @endif
                        @if ($employee->marital_status !==1 && $employee->marital_status!==2 && $employee->marital_status !==3)
                            Not Selected
                        @endif
                    </td>
                    <td style="word-wrap: break-word; max-width:100px">{{ $employee->address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">
                        <h4 class="my-5 text-center">
                            No Employees Found
                        </h4>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
