<form action="{{ route('employees.store') }}" method="POST" class="bg-body-tertiary my-3 border p-3 rounded" enctype="multipart/form-data">
    @csrf
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="" class="form-label">@lang('public.employee_id') <span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" disabled value="{{ $default_emp_id }}">
            <input type="hidden" name="employee_id" class="form-control" value="{{ $default_emp_id }}">
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="employee_code" class="form-label">@lang('public.employee_code') <span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4">
            <input id="employee_code" type="text" name="employee_code" class="form-control @error('employee_code')
                is-invalid
            @enderror" value="{{ old('employee_code') }}">
            @error('employee_code')
                <div class=" invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="employee_name" class="form-label">@lang('public.employee_name') <span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4">
            <input id="employee_name" type="text" name="employee_name" class="form-control  @error('employee_name')
                is-invalid
            @enderror"  value="{{ old('employee_name') }}">
            @error('employee_name')
                <div class=" invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="nrc_number" class="form-label">@lang('public.nrc_number') <span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4">
            <input id="nrc_number" type="text" name="nrc_number" class="form-control  @error('nrc_number')
                is-invalid
            @enderror"  value="{{ old('nrc_number') }}">
            @error('nrc_number')
                <div class=" invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="password" class="form-label">@lang('public.password') <span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4 relative">
            <div class="input-group">
                <input id="password" type="password" name="password" class="form-control  @error('password')
                is-invalid
                @enderror" id="password"  value="{{ old('password') }}">
                <button id="showPasswordButton" type="button" class="bi bi-eye-fill input-group-text"></button>
            </div>
            @error('password')
                <div class=" invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <button type="button" id="generatePassword" class="btn btn-primary">@lang('public.generate_password')</button>
        </div>
    </div>
    <div class="text-danger d-flex gap-3 align-items-center">
        <i class="bi bi-exclamation-triangle mb-0"></i>
        <p class="mb-0">@lang('public.password_length')</p>
    </div>

    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="email_address" class="form-label">@lang('public.email_address')<span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4">
            <input id="email_address" type="text" name="email_address" class="form-control  @error('email_address')
                is-invalid
            @enderror"  value="{{ old('email_address') }}">
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
                <input type="radio" id="male" name="gender" value="1" class=" form-check-input" {{ old('gender') == 1 ? 'checked' : '' }}>
            </div>
            <div class=" form-check">
                <label for="female" class=" form-check-label">@lang('public.female')</label>
                <input type="radio" id="female" name="gender" value="2" class=" form-check-input" {{ old('gender') == 2 ? 'checked' : '' }}>
            </div>
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="date_of_birth" class="form-label">@lang('public.date_of_birth')<span class=" text-danger">*</span></label>
        </div>
        <div class="col-md-4">
            <input id="date_of_birth" type="date" value="{{ old('date_of_birth') }}" name="date_of_birth" class="form-control  @error('date_of_birth')
                is-invalid
            @enderror">
            @error('date_of_birth')
                <div class=" invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-md-3">
            <label for="marital_status" class="form-label">@lang('public.marital_status')</label>
        </div>
        <div class="col-md-4 d-flex gap-3">
           <select name="marital_status" class="form-select" id="marital_status">
                <option value="none">---Select---</option>
                <option value="1" {{ old('marital_status') == 1 ? 'selected' : '' }}>@lang('public.single')</option>
                <option value="2" {{ old('marital_status') == 2 ? 'selected' : '' }}>@lang('public.married')</option>
                <option value="3" {{ old('marital_status') == 3 ? 'selected' : '' }}>@lang('public.divorced')</option>
           </select>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-3">
            <label for="address" class="form-label">@lang('public.address')</label>
        </div>
        <div class="col-md-9">
           <textarea name="address" class=" form-control" id="address" cols="30" rows="4"> {{ old('address') }}</textarea>
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
           <img src="" id="uploadedPhoto" class="mt-3 object-fit-cover d-none rounded-pill" width="200" height="200" alt="">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger d-none" id="removePhoto">@lang('public.remove')</button>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5 mb-3">
        <button class=" btn btn-primary px-5 py-2" type="submit">@lang('public.save')</button>
    </div>
</form>
