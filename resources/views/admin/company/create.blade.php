@extends('layouts.main')

@section('title', '| Add Company')
@section('content')
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Company</h3>
    </div>
    <div class="panel-body">
        @if (Session::has('failed'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> {{ Session::get('failed') }}
            </div>
        @endif
        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.company._formCreate')
        </form>
    </div>
@endsection
