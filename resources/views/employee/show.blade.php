@extends('layouts.app')

@section('title')
    Employee Detail
@endsection

@section('content')

            <div class="bg-white border rounded p-3 my-3">
                <p class="fs-4"><i class="bi bi-person me-2"></i>Employee Detail Information</p>
            <div class="my-3">
                <div class="row my-4">
                    <div class="col-md-4 d-flex gap-3">
                        <img src="{{ asset($employeePhoto) }}" width="180" height="180" class="object-fit-cover rounded-pill" alt="Employee photo">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Employee ID <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" disabled value="{{ $employee->employee_id }}">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Employee Code <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="employee_code" class="form-control" disabled value={{ $employee->employee_code }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Employee Name <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="employee_name" class="form-control" disabled value="{{ $employee->employee_name }}">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">NRC Number <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="nrc_number" class="form-control" disabled value={{ $employee->nrc_number }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Email Address <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="email_address" class="form-control" disabled value={{ $employee->email_address }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Gender</label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                        <div class=" form-check">
                            <label for="male" class=" form-check-label">Male</label>
                            <input type="radio" id="male" name="gender" value="1" class=" form-check-input" {{ $employee->gender == 1 ? 'checked' : '' }} disabled>
                        </div>
                        <div class=" form-check">
                            <label for="female" class=" form-check-label">Female</label>
                            <input type="radio" id="female" name="gender" value="2" class=" form-check-input" {{ $employee->gender == 2 ? 'checked' : '' }} disabled>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Date of Birth <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                        <input type="date" name="date_of_birth" class="form-control" disabled value={{ $employee->date_of_birth }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Marital Status </label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                       <select name="marital_status" class="form-select" id="" disabled>
                            <option>Not selected</option>
                            <option value="1" {{ $employee->marital_status == 1 ? 'selected' : '' }}>Single</option>
                            <option value="2" {{ $employee->marital_status == 2 ? 'selected' : '' }}>Married</option>
                            <option value="3" {{ $employee->marital_status == 3 ? 'selected' : '' }}>Divorced</option>
                       </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">Address </label>
                    </div>
                    <div class="col-md-9">
                       <textarea name="address" class=" form-control" id="" cols="30" rows="4" disabled> {{ $employee->address }}</textarea>
                    </div>
                </div>

            </div>
            </div>


@endsection
