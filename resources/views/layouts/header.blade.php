<nav class="py-2 bg-white border border-b sticky-top">
    <div class=" container d-flex align-items-center justify-content-between">
      <a href="{{ route('employees.index') }}" class=" fs-4 text-decoration-none text-black d-flex align-items-center gap-2">
        <img src="{{ asset('logos/hero-logo.svg') }}" width="30px" alt="">
        <span>
          @lang('public.title')
        </span></a>
      <ul class=" nav nav-underline d-flex list-unstyled gap-4 align-items-center mb-0" >
          <li class="nav-item">
              <a href="{{ route('employees.create',['register_type'=>1]) }}" class=" nav-link text-black {{ request()->path()=='employees/create' ? 'active' : '' }}"  >@lang('public.register')</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('employees.index') }}" class=" nav-link text-black {{ request()->path()=='employees' ? 'active' : '' }}">@lang('public.list')</a>
          </li>
          <li class="nav-item dropdown">
            <div style="cursor:pointer"  data-bs-toggle="dropdown">
                <img src="{{ session('locale') == 'en' ? asset('logos/uk-flag.svg') : asset('logos/myanmar-flag.svg') }}" width="30px" alt="">
            </div>
            <ul class="dropdown-menu dropdown-menu-light mt-3">
                <a href="{{ route('lang','en') }}" class=" d-block dropdown-item"><img src="{{ asset('logos/uk-flag.svg') }}" width="30px" alt="" class="me-1"> English </a>
                <div class=" dropdown-divider"></div>
                <a href="{{ route('lang','mm') }}" class=" d-block dropdown-item"><img src="{{ asset('logos/myanmar-flag.svg') }}" width="30px" alt="" class="me-1"> မြန်မာ</a>
            </ul>
          </li>
          <li class="nav-item dropdown d-flex align-items-center gap-2 ">
            <div class="text-black-50">|</div>

            <div class="dropdown-toggle " style="cursor:pointer"  data-bs-toggle="dropdown">
                <img src="{{ session('employee_photo') }}" class="rounded-circle border border-2 object-fit-cover "  width="30px" height="30px" alt="">
            </div>
            <ul class="dropdown-menu dropdown-menu-light mt-3">

              <li>
                <a class="dropdown-item " href="{{ route('employees.show',session('employee')->id) }}">
                    <p class="mb-0">{{ session('employee')->employee_name}}</p>
                    <p class="mb-0 small text-black-50">{{ session('employee')->email_address}}</p>
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button class="btn btn-primary dropdown-item">@lang('public.logout')</button>
                </form>
            </li>
            </ul>
          </li>
      </ul>
    </div>
  </nav>
