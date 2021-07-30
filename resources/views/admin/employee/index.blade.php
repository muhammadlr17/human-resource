@extends('layouts.main')

@section('title', '| Employee')
@section('content')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Employees</h3>
            <a href="{{ url('employees/create') }}" class="btn btn-md btn-success text-light">
                <i class="fa fa-plus"></i> Add
            </a>
            <a href="{{ url('employees/trash') }}" class="btn btn-md btn-warning text-light">
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
                                            href="{{ url('employees/company/' . $employee->company->id) }}">{{ $employee->company->name }}</a>
                                    </td>
                                    <td><a
                                            href="{{ url('employees/departement/' . $employee->departement->id) }}">{{ $employee->departement->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('employees/' . $employee->id) }}"
                                            class="btn btn-xs btn-info text-light"><span class="lnr lnr-eye"></span></a>
                                        <a href="{{ url('employees/' . $employee->id . '/edit') }}"
                                            class="btn btn-xs btn-warning text-light"><span
                                                class="lnr lnr-pencil"></span></a>
                                        <form method="POST" action="{{ url('employees/' . $employee->id) }}"
                                            style="display: inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger"><span
                                                    class="lnr lnr-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endsection