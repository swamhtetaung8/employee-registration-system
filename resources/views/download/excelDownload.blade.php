<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee ID</th>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>NRC Number</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of birth</th>
                <th>Marital Status</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
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
