@extends('layouts.app')

@section('title')
    @lang('public.employee_edit')
@endsection

@section('content')
            @if (session('error'))
            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{ route('employees.update',$employee->id) }}" method="POST" class="bg-body-tertiary border rounded p-3 my-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="fs-4 mb-0"><i class="bi bi-person me-2"></i><span class=" border-bottom border-3 border-primary">@lang('public.employee_edit')</span> </p>
                </div>
                <a href="{{ session("prev_url_$employee->id") ?? route('employees.index') }}" class=" btn btn-outline-primary">Back</a>
            </div>
            <div class="my-3">
                <div class="row my-4">
                    <div class="col-md-4 d-flex gap-3">
                        <img src="{{ asset($employeePhoto) }}" id="employeePhoto" width="180" height="180" class="object-fit-cover rounded-pill" alt="Employee photo">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.employee_id')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" disabled value="{{ $employee->employee_id }}">
                        <input type="hidden" name="employee_id" class="form-control" value="{{ $employee->employee_id }}">
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.employee_code')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="employee_code" class="form-control @error('employee_code')
                            is-invalid
                        @enderror" value="{{ old('employee_code',$employee->employee_code) }}">
                        @error('employee_code')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.employee_name')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="employee_name" class="form-control @error('employee_name')
                            is-invalid
                        @enderror" value="{{ old('employee_name',$employee->employee_name) }}">
                        @error('employee_name')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.nrc_number')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="nrc_number" class="form-control @error('nrc_number')
                            is-invalid
                        @enderror" value="{{ old('nrc_number',$employee->nrc_number) }}">
                        @error('nrc_number')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.email_address')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="email_address" class="form-control @error('email_address')
                            is-invalid
                        @enderror" value="{{ old('email_address',$employee->email_address) }}">
                        @error('email_address')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.gender')</label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                        <div class=" form-check">
                            <label for="male" class=" form-check-label">@lang('public.male')</label>
                            <input type="radio" id="male" name="gender" value="1" class=" form-check-input" {{ ($employee->gender == 1 || old('gender') ==1 ) ? 'checked' : '' }} >
                        </div>
                        <div class=" form-check">
                            <label for="female" class=" form-check-label">@lang('public.female')</label>
                            <input type="radio" id="female" name="gender" value="2" class=" form-check-input" {{ ($employee->gender == 2 || old('gender') ==2 ) ? 'checked' : '' }} >
                        </div>
                    </div>
                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.date_of_birth')<span class=" text-danger">*</span></label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date_of_birth" class="form-control @error('date_of_birth')
                            is-invalid
                        @enderror" value={{ old('date_of_birth',$employee->date_of_birth) }}>
                        @error('date_of_birth')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                    </div>

                </div>
                <div class="row align-items-center my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.marital_status')</label>
                    </div>
                    <div class="col-md-4 d-flex gap-3">
                       <select name="marital_status" class="form-select" id="">
                            <option value="none">---Select---</option>
                            <option value="1" {{ ($employee->marital_status == 1 || old('marital_status') ==1) ? 'selected' : '' }}>@lang('public.single')</option>
                            <option value="2" {{ ($employee->marital_status == 2 || old('marital_status') ==2) ? 'selected' : '' }}>@lang('public.married')</option>
                            <option value="3" {{ ($employee->marital_status == 3 || old('marital_status') ==3) ? 'selected' : '' }}>@lang('public.divorced')</option>
                       </select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <label for="" class="form-label">@lang('public.address') </label>
                    </div>
                    <div class="col-md-9">
                       <textarea name="address" class=" form-control" id="" cols="30" rows="4">{{ old('address',$employee->address) }}</textarea>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-3">
                        <label for="photo" class="form-label">@lang('public.upload_photo')</label>
                    </div>
                    <div class="col-md-4">
                       <input type="file" id="photo" name="photo" class=" form-control @error('photo')
                            is-invalid
                       @enderror" >
                       @error('photo')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                       @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger d-none" id="removePhoto">@lang('public.remove')</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5 mb-3">
                <button class=" btn btn-primary px-5 py-2" type="submit">@lang('public.update')</button>
            </div>
        </form>
@endsection

@section('script')
<script>
    const photo = document.getElementById('photo')
    const removePhoto = document.getElementById('removePhoto')
    const employeePhoto = document.getElementById('employeePhoto')
    const originalPhoto = '{{ asset($employeePhoto) }}'
    function displayPhoto() {
            let file = photo.files[0]
            let reader = new FileReader()

            reader.onload = function(e) {
                employeePhoto.src = e.target.result
            };
            reader.readAsDataURL(file)
        }
    photo.addEventListener('change',function(){
            if(photo.files.length == 0){
                employeePhoto.src = originalPhoto
                removePhoto.classList.add('d-none')
            }else{
                if(photo.files[0].type.includes('image')){
                displayPhoto()
                removePhoto.classList.remove('d-none')
            }
            }
        })

        removePhoto.addEventListener('click',function(){
            photo.value=null
            removePhoto.classList.add('d-none')
            employeePhoto.src = originalPhoto
        })
</script>
@endsection
