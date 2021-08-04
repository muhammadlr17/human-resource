@extends('layouts.main')

@section('title', '| Edit Employee')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Employees : <b>{{ $employee->first_name . ' ' . $employee->last_name }}</b></h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.employee._formEdit')
                <div class=" pull-right"> <a href="{{ route('employees.reset', $employee->username) }}"
                        class="btn btn-md btn-warning text-light">
                        <i class="fa fa-lock"></i> Reset Password
                    </a>
                </div>
            </form>
        </div>
    @endsection
