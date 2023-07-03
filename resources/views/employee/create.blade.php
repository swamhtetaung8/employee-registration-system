@extends('layouts.app')

@section('title')
    Employee Register
@endsection



@section('content')

    @if (session('error'))
        <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @error('excel')
        <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    @if (session('excelError'))
    @foreach (session('excelError') as $error)
    <div class=" alert alert-danger my-3">
        <p class="mb-0">Row - {{ $error['row'] }}</p>
        @foreach ($error['errors']->toArray() as $key=>$value)
            <div class="row">
                <div class="col">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $value[0] }}
                </div>
            </div>
        @endforeach
    </div>
    @endforeach
    @endif
    <form action="{{ route('employees.create') }}" method="GET" class="bg-white d-flex gap-5 my-3 border p-3 rounded">
        <div class=" form-check">
            <input type="radio" id="normal" class=" form-check-input" name="register_type" value="1" {{ request()->register_type == 1 ? 'checked' : '' }}>
            <label for="normal" class=" form-check-label">Normal Register</label>
        </div>
        <div class=" form-check">
            <input type="radio" id="excel" class=" form-check-input" name="register_type" value="2" {{ request()->register_type == 2 ? 'checked' : '' }}>
            <label for="excel" class=" form-check-label">Excel Register</label>
        </div>
        <input id="changeSubmitType" type="submit" class=" d-none">
    </form>

    @if (request()->register_type == 1)
        @include('employee.normalregister')

    @endif

    @if (request()->register_type == 2)
        @include('employee.excelregister')
    @endif

    @section('script')
    <script>
        const normal = document.getElementById('normal');
        const excel = document.getElementById('excel');
        normal.addEventListener('click', function(){
            changeSubmitType.click()
        });
        excel.addEventListener('click', function(){
            changeSubmitType.click()
        });
    </script>
    @if (request()->register_type == 1)
    <script>
        const changeSubmitType = document.getElementById('changeSubmitType')
        const password = document.getElementById('password')
        const generatePassword = document.getElementById('generatePassword')
        const showPasswordButton = document.getElementById("showPasswordButton")
        const photo = document.getElementById("photo")
        const uploadedPhoto = document.getElementById("uploadedPhoto")
        const removePhoto = document.getElementById("removePhoto")
        function displayPhoto() {
            let file = photo.files[0]
            let reader = new FileReader()

            reader.onload = function(e) {
                uploadedPhoto.src = e.target.result
                uploadedPhoto.classList.remove('d-none')
            };

            reader.readAsDataURL(file)
        }
        function generatePasswordFn() {
            let length = 8
            let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-="
            let dummyPassword = ""

            dummyPassword += getRandomCharacter("abcdefghijklmnopqrstuvwxyz")
            dummyPassword += getRandomCharacter("ABCDEFGHIJKLMNOPQRSTUVWXYZ")
            dummyPassword += getRandomCharacter("0123456789")
            dummyPassword += getRandomCharacter("!@#$%^&*()_+~`|}{[]:;?><,./-=")

            for (let i = 4; i < length; i++) {
                let randomIndex = Math.floor(Math.random() * charset.length)
                dummyPassword += charset[randomIndex]
            }

            password.value = dummyPassword
        }

        function getRandomCharacter(charset) {
            let randomIndex = Math.floor(Math.random() * charset.length)
            return charset[randomIndex];
        }
        photo.addEventListener('change',function(){
            if(photo.files.length == 0){
                uploadedPhoto.classList.add('d-none')
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
            uploadedPhoto.classList.add('d-none')
        })

        generatePassword.addEventListener('click',generatePasswordFn)
        showPasswordButton.addEventListener("click", function () {
        if (showPasswordButton.className == "bi bi-eye-fill input-group-text") {
            password.type = "text"
            showPasswordButton.className = "bi bi-eye-slash-fill input-group-text"
        } else {
            password.type = "password"
            showPasswordButton.className = "bi bi-eye-fill input-group-text"
        }
        })
    </script>

    @endif
    @if (request()->register_type == 2)
    <script>
        const excelDrop = document.getElementById("excelDrop");
        const excelInput = document.getElementById("excelInput");
        const fileName = document.getElementById("fileName");
        excelDrop.addEventListener('click',function(){
            excelInput.click()
        })
        excelInput.addEventListener('change',function(){
            fileName.innerText = excelInput.files[0].name
        })

    </script>

    @endif
    @endsection
@endsection
