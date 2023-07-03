<nav class="py-2 bg-white border border-b">
    <div class=" container d-flex align-items-center justify-content-between">
      <p class=" fs-4 mb-0">Employee Registration System</p>
      <ul class=" nav nav-underline d-flex list-unstyled gap-3 align-items-center mb-0">
          <li class="nav-item">
              <a href="{{ route('employees.create',['register_type'=>1]) }}" class=" nav-link text-black {{ request()->path()=='employees/create' ? 'active' : '' }}"  >Register</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('employees.index') }}" class=" nav-link text-black {{ request()->path()=='employees' ? 'active' : '' }}">List</a>
          </li>
          @if (session('employee'))
          <li class="nav-item">
            <p class="mb-0 small">{{ session('employee')->employee_name }}</p>
        </li>
          @endif
          <li>
              <form action="{{ route('auth.logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-primary">Logout</button>
              </form>
          </li>
      </ul>
    </div>
  </nav>
