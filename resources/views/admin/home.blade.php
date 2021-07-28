@extends('layouts.main')

@section('title', '| Dashboard')
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
            <p class="panel-subtitle">Welcome, <b>{{ Auth::user()->first_name }}</b></p>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="metric">
                        <span class="icon"><i class="lnr lnr-apartment"></i></span>
                        <p>
                            <span class="number">{{ $companies }}</span>
                            <a href="{{ url('companies') }}"><span class="title">Companies</span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span class="icon"><i class="lnr lnr-license"></i></span>
                        <p>
                            <span class="number">{{ $departements }}</span>
                            <a href="{{ url('departements') }}"><span class="title">Departements</span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric">
                        <span class="icon"><i class="lnr lnr-users"></i></span>
                        <p>
                            <span class="number">{{ $employees }}</span>
                            <a href="{{ url('employees') }}"><span class="title">Employees</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
