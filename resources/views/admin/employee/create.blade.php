@extends('layouts.main')

@section('title', '| Add Employee')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Employee</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.employee._formCreate')
            </form>
        </div>
    @endsection
