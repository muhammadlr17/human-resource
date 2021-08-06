@extends('layouts.main')

@section('title', '| Edit Company')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Company : <b>{{ $company->first_name . ' ' . $company->last_name }}</b></h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('companies.update', $company) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('admin.company._formEdit')
            </form>
        </div>
    @endsection
