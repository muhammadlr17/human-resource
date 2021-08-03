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
                @include('admin.employee._form')
            </form>
        </div>
    @endsection
