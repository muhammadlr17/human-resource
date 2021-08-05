@extends('layouts.main')

@section('title', '| Detail')
@section('content')
    <div class="panel panel-profile">
        <div class="clearfix">
            <!-- LEFT COLUMN -->
            <div class="profile-left">
                <!-- PROFILE HEADER -->
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                        @if (strlen($employee->photo) > 0)
                            <img src="{{ asset('image/profile/' . $employee->photo) }}" width="100px" class="img-circle">
                        @else
                            <img src="{{ asset('image/profile/default.png') }}" width="100px" class="img-circle">
                        @endif
                        <h3 class="name">{{ $employee->first_name . ' ' . $employee->last_name }}</h3>
                        <span class="online-status status-available">Available</span>
                    </div>
                </div>
                <!-- END PROFILE HEADER -->
                <!-- PROFILE DETAIL -->
                <div class="profile-detail">
                    <div class="profile-info">
                        <h3 class="heading">About</h3>
                        <ul class="list-unstyled list-justify">
                            <li>Username <span>{{ $employee->username }}</span></li>
                            <li>Email <span>{{ $employee->email }}</span></li>
                            <li>Phone <span>{{ $employee->phone }}</span></li>
                            <li>Company <span><a
                                        href="{{ route('employees.company', $employee->company->slug) }}">{{ $employee->company->name }}</a></span>
                            </li>
                            <li>Departement <span><a
                                        href="{{ route('employees.departement', $employee->departement->slug) }}">{{ $employee->departement->name }}</a></span>
                            </li>
                        </ul>
                    </div>
                    <div class="profile-info">
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
                <!-- END PROFILE DETAIL -->
            </div>
            <!-- END LEFT COLUMN -->
            <!-- RIGHT COLUMN -->
            <div class="profile-right">
                <h4 class="heading">
                    <a href="{{ route('employees.index') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
                </h4>
                <!-- TABBED CONTENT -->
                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                        <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Recent Activity</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <ul class="list-unstyled activity-timeline">
                            <li>
                                <i class="fa fa-comment activity-icon"></i>
                                <p>Commented on post <a href="#">Prototyping</a> <span class="timestamp">2 minutes
                                        ago</span></p>
                            </li>
                            <li>
                                <i class="fa fa-cloud-upload activity-icon"></i>
                                <p>Uploaded new file <a href="#">Proposal.docx</a> to project <a href="#">New Year
                                        Campaign</a> <span class="timestamp">7 hours ago</span></p>
                            </li>
                            <li>
                                <i class="fa fa-plus activity-icon"></i>
                                <p>Added <a href="#">Martin</a> and <a href="#">3 others colleagues</a> to project
                                    repository <span class="timestamp">Yesterday</span></p>
                            </li>
                            <li>
                                <i class="fa fa-check activity-icon"></i>
                                <p>Finished 80% of all <a href="#">assigned tasks</a> <span class="timestamp">1 day
                                        ago</span></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END TABBED CONTENT -->
            </div>
            <!-- END RIGHT COLUMN -->
        </div>
    </div>
@endsection
