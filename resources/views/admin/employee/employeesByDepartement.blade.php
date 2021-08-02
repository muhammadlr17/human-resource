@extends('layouts.main')

@section('title', '| Employee by Company')
@section('content')
    <h3 class="page-title">Employees by Departement</h3>
    @foreach ($employees as $employee)
        <div class="col-md-4">
            <!-- PANEL NO PADDING -->
            <div class="panel">
                <div class="panel-heading">
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="{{ asset('assets/img/user-medium.png') }}" class="img-circle" alt="Avatar">
                            <h3 class="name">{{ $employee->first_name . ' ' . $employee->last_name }}</h3>
                            <span class="online-status status-available">Available</span>
                        </div>
                        <div class="profile-stat">
                            <div class="row">
                                <div class="col-md-4 stat-item">
                                    Comp. <span>{{ $employee->company->name }}</span>
                                </div>
                                <div class="col-md-4 stat-item">
                                    Dept. <span>{{ $employee->departement->name }}</span>
                                </div>
                                <div class="col-md-4 stat-item">
                                    Role <span>{{ $employee->role }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PANEL NO PADDING -->
        </div>
    @endforeach
@endsection
