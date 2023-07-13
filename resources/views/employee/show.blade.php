@extends('layouts.app')

@section('title')
    @lang('public.employee_detail')
@endsection

@section('content')
            <div class="bg-body-tertiary border rounded p-3 my-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="fs-4 mb-0"><i class="bi bi-person me-2"></i><span class=" border-bottom border-3 border-primary"> @lang('public.employee_detail')</span></p>
                    </div>
                </div>
            <div class="my-3">
                <div class="row my-4">
                    <div class="col-md-4 d-flex gap-3">
                        <img src="{{ asset($employeePhoto) }}" width="180" height="180" class="object-fit-cover rounded-pill" alt="Employee photo">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.employee_id') <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" disabled value="{{ $employee->employee_id }}">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.employee_code')  <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="employee_code" class="form-control" disabled value={{ $employee->employee_code }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.employee_name') <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="employee_name" class="form-control" disabled value="{{ $employee->employee_name }}">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.nrc_number')  <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="nrc_number" class="form-control" disabled value={{ $employee->nrc_number }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.email_address') <span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="email_address" class="form-control" disabled value={{ $employee->email_address }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.gender') </label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                        <div class=" form-check">
                            <label for="male" class=" form-check-label">@lang('public.male')</label>
                            <input type="radio" id="male" name="gender" value="1" class=" form-check-input" {{ $employee->gender == 1 ? 'checked' : '' }} disabled>
                        </div>
                        <div class=" form-check">
                            <label for="female" class=" form-check-label">@lang('public.female')</label>
                            <input type="radio" id="female" name="gender" value="2" class=" form-check-input" {{ $employee->gender == 2 ? 'checked' : '' }} disabled>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.date_of_birth')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                        <input type="date" name="date_of_birth" class="form-control" disabled value={{ $employee->date_of_birth }}>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.marital_status')</label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                       <select name="marital_status" class="form-select" id="" disabled>
                            <option>Not selected</option>
                            <option value="1" {{ $employee->marital_status == 1 ? 'selected' : '' }}>@lang('public.single')</option>
                            <option value="2" {{ $employee->marital_status == 2 ? 'selected' : '' }}>@lang('public.married')</option>
                            <option value="3" {{ $employee->marital_status == 3 ? 'selected' : '' }}>@lang('public.divorced')</option>
                       </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.address') </label>
                    </div>
                    <div class="col-md-9">
                       <textarea name="address" class=" form-control" id="" cols="30" rows="4" disabled> {{ $employee->address }}</textarea>
                    </div>
                </div>

            </div>
            </div>


@endsection
