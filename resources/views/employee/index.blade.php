@extends('layouts.app')

@section('title')
    @lang('public.employee_list')
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="bg-white border rounded p-3 my-3">
        <p class="fs-4"><i class="bi bi-people me-2"></i> @lang('public.employee_list')</p>
        <form id="searchForm" action="{{ route('employees.index') }}" class="my-3">
            <div class="row my-4">
                <div class="col-6">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label for="employee_id">@lang('public.employee_id')</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="employee_id" class=" form-control" id="employee_id" value="{{ request()->employee_id  ??null }}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label for="employee_code">@lang('public.employee_code')</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="employee_code" class=" form-control" id="employee_code" value="{{ request()->employee_code??null }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-6">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label for="employee_name">@lang('public.employee_name')</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="employee_name" class=" form-control" id="employee_name" value="{{ request()->employee_name??null }}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label for="email">@lang('public.email_address')</label>
                        </div>
                        <div class="col-6">
                            <input type="text" name="email_address" class=" form-control" id="email" value="{{ request()->email_address??null }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-5 mt-5">
                <button class="btn btn-primary">@lang('public.search')</button>
                <a href="{{ route('employees.download') }}?{{ http_build_query(request()->all()) }}&type=1" class="btn btn-primary {{ count($employees) == 0 ? 'disabled' : '' }}">@lang('public.pdf_download')</a>
                <a href="{{ route('employees.download') }}?{{ http_build_query(request()->all()) }}&type=2" class="btn btn-primary {{ count($employees) == 0 ? 'disabled' : '' }}">@lang('public.excel_download')</a>
                @if (request()->employee_id !='' || request()->employee_code !='' || request()->employee_name !='' || request()->email_address !='')
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-danger">@lang('public.reset_search')</a>
                @endif
            </div>
        </form>

        <div class="table-responsive my-4">

            <table class="table table-bordered table-hover">
                <thead class="text-center align-middle">
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">@lang('public.employee_id')</th>
                        <th rowspan="2">@lang('public.employee_code')</th>
                        <th rowspan="2">@lang('public.employee_name')</th>
                        <th rowspan="2">@lang('public.email_address')</th>

                        <th colspan="4">
                            @lang('public.actions')
                        </th>

                    </tr>
                    <tr>
                        <th>@lang('public.edit')</th>
                        <th>@lang('public.detail')</th>
                        <th>Active/Inactive</th>
                        <th>@lang('public.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr class="align-middle">
                            <td class="text-center">{{ $employee->id }}</td>
                            <td class="text-center">{{ $employee->employee_id }}</td>
                            <td class="text-center">{{ $employee->employee_code }}</td>
                            <td class="text-center">{{ $employee->employee_name }}</td>
                            <td class="text-center">{{ $employee->email_address }}</td>
                            <td class="text-center">
                                @if ($employee->deleted_at==null)
                                <a href="{{ route('employees.edit',$employee->id) }}" class="btn bi bi-pencil-square text-black"></a>
                                @else
                                <i class=" btn pe-none bi bi-pencil-square text-black-50"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('employees.show',$employee->id) }}" class="btn bi bi-journal-text text-success"></a>
                            </td>
                            <td class="text-center">
                                @if ($employee->deleted_at==null)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$employee->employee_id.'inactive'}}">
                                    Active
                                </button>
                                <div class="modal fade" id="{{$employee->employee_id.'inactive'}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content px-4 py-5">
                                        <p class=" fs-5">@lang('public.inactive_modal')</p>
                                        <div class="d-flex gap-5 justify-content-evenly align-items-center mt-3">
                                            <form action="{{ route('employees.inactive',$employee->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-success">
                                                  Inactive
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('public.close')</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                @else
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#{{$employee->employee_id.'active'}}">
                                    Inactive
                                </button>
                                <div class="modal fade" id="{{$employee->employee_id.'active'}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content px-4 py-5">
                                        <p class=" fs-5">@lang('public.active_modal')</p>
                                        <div class="d-flex gap-5 justify-content-evenly align-items-center mt-3">
                                            <form action="{{ route('employees.active',$employee->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-success">
                                                  Active
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('public.close')</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($employee->deleted_at==null)
                                    <button type="button" class="bi bi-trash text-danger btn text-center" data-bs-toggle="modal" data-bs-target="#{{$employee->employee_id.'delete'}}">
                                    </button>
                                @else
                                    <i class=" btn pe-none bi bi-trash text-black-50"></i>
                                @endif
                                <div class="modal fade" id="{{$employee->employee_id.'delete'}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content px-4 py-5">
                                        <p class=" fs-5">@lang('public.delete_modal')</p>
                                        <div class="d-flex gap-5 justify-content-evenly align-items-center mt-3">
                                            <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-success">
                                                    Delete
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('public.close')</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h4 class="my-5 text-center">
                                    @lang('public.not_found')
                                </h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
