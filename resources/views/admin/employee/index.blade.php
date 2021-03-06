@extends('layouts.main')

@section('title', '| Employee')
@section('content')
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Employees</h3>
        <a href="{{ route('employees.create') }}" class="btn btn-xs btn-success text-light">
            <i class="fa fa-plus"></i> Add
        </a>
        <a href="{{ route('employees.trash') }}" class="btn btn-xs btn-warning text-light">
            <i class="fa fa-trash"></i> Recycle Bin
        </a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Departement</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($employees->count() > 0)
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td><a
                                        href="{{ route('employees.company', $employee->company->slug) }}">{{ $employee->company->name }}</a>
                                </td>
                                <td><a
                                        href="{{ route('employees.departement', $employee->departement->slug) }}">{{ $employee->departement->name }}</a>
                                </td>
                                <td class="text-center">
                                    @if (strlen($employee->photo) > 0)
                                        <img src="{{ asset('image/profile/' . $employee->photo) }}" width="30px"
                                            class="img-circle">
                                    @else
                                        <img src="{{ asset('image/profile/default.png') }}" width="30px"
                                            class="img-circle">
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('employees.show', $employee) }}"
                                        class="btn btn-xs btn-info text-light"><span
                                            class="small lnr lnr-eye"></span></a>
                                    <a href="{{ route('employees.edit', $employee) }}"
                                        class="btn btn-xs btn-warning text-light"><span
                                            class="small lnr lnr-pencil"></span></a>
                                    {{-- <form method="POST" action="{{ route('employees.destroy', $employee) }}"
                                        style="display: inline" onsubmit="return confirm('Yakin hapus data?')">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-xs btn-danger"><span
                                                class="small lnr lnr-trash"></span></button>
                                    </form> --}}
                                    <button onclick="deleteItem(this)" data-username="{{ $employee->username }}"
                                        class="btn btn-xs btn-danger"><i class="lnr lnr-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.employee.remove_script')
@endsection
