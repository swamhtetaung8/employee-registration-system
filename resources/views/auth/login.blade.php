@extends('layouts.app')

@section('title')
Login
@endsection

@section('content')
<div class=" min-vh-100 w-100 d-flex justify-content-center align-items-center">
    <div class="bg-white border rounded-4 px-5 py-4 shadow-sm text-center">
        <img src="{{ asset('logos/hero-logo.svg') }}" width="100px" class="mx-auto mb-2" alt="">
        <h3>@lang('public.title')</h3>
        @if ($errors->any())
            <div class="alert alert-danger my-3">
                <p class="mb-0 d-flex gap-3">
                    @error('employee_id')
                        <i class="bi bi-exclamation-triangle mb-0"></i>
                        {{ $message }}
                    @enderror
                </p>
                <p class="mb-0 d-flex gap-3">
                    @error('password')
                        <i class="bi bi-exclamation-triangle mb-0"></i>
                        {{ $message }}
                    @enderror
                </p>
            </div>
        @endif
        <form id="loginForm" action="{{ route('auth.check') }}" method="POST" class="my-4">
            @csrf
            <div class="my-3">
                <input autofocus type="text" name="employee_id" placeholder="@lang('public.employee_id')" class="form-control">
            </div>
            <div class="input-group">
                <input id="password" placeholder="@lang('public.password')" type="password" name="password" class="form-control" id="password">
                <button id="showPasswordButton" type="button" class="bi bi-eye-fill input-group-text"></button>
            </div>
        </form>
        <div class=" d-flex justify-content-center">
            <button form="loginForm" type="submit" class="btn btn-primary px-4 py-2">@lang('public.login')</button>
        </div>
    </div>
</div>
@section('script')
<script>
    const password = document.getElementById('password');
    const showPasswordButton = document.getElementById('showPasswordButton');

    showPasswordButton.addEventListener("click", function () {
        if (showPasswordButton.className == "bi bi-eye-fill input-group-text") {
            password.type = "text";
            showPasswordButton.className = "bi bi-eye-slash-fill input-group-text";
        } else {
            password.type = "password";
            showPasswordButton.className = "bi bi-eye-fill input-group-text";
        }
    });
</script>
@endsection
@endsection
