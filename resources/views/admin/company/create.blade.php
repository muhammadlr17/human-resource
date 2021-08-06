@extends('layouts.main')

@section('title', '| Add Company')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Add New Company</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.company._formCreate')
            </form>
        </div>
    @endsection
