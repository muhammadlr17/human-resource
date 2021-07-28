@extends('layouts.main')

@section('title', '| Dashboard')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
            <p class="panel-subtitle">Welcome, <b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></p>
        </div>
        <div class="panel-body">

        </div>
    </div>
@endsection
