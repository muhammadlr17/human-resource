@extends('layouts.main')

@section('title', '| Trash Employee')
@section('content')
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <i class="fa fa-check-circle"></i> {{ Session::get('success') }}
    </div>
@endif
@if (Session::has('failed'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <i class="fa fa-times-circle"></i> {{ Session::get('failed') }}
    </div>
@endif
<div class="panel panel-body">
    <a href="{{ route('employees.index') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
    <a href="{{ route('employees.restore') }}" class="btn btn-xs btn-success text-light">
        <i class="fa fa-undo"></i> Restore All
    </a>
    <button onclick="deleteItem(this)" data-username="" class="btn btn-xs btn-danger"><span class="fa fa-trash"></span>
        Delete Permanently All</button>
</div>
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Trash Employees</h3>
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
                                    <a href="{{ route('employees.restore', $employee->username) }}"
                                        class="btn btn-xs btn-success text-light"><span class="lnr lnr-undo"></span></a>
                                    {{-- <form method="POST" action="{{ route('employees.delete', $employee->username) }}"
                                            style="display: inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger"><span
                                                    class="lnr lnr-trash"></span></button>
                                        </form> --}}
                                    <button onclick="deleteItem(this)" data-username="{{ $employee->username }}"
                                        class="btn btn-xs btn-danger"><span class="lnr lnr-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.employee.delete_script')
@endsection
