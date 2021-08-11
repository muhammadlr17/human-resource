@extends('layouts.main')

@section('title', '| Dashboard')
@section('content')
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Cleaner Page</h3>
        <p class="panel-subtitle">To solve problems in system, please clean by click button below!</b></p>
    </div>
    <div class="panel-body">
        <button onclick="clean()" class="btn btn-lg btn-primary"><i class="fa fa-refresh"></i>
            Clean System
        </button>
    </div>
</div>
@include('admin.script')
@endsection
