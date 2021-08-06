@extends('layouts.main')

@section('title', '| Profile')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('failed'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i> {{ Session::get('failed') }}
        </div>
    @endif
    <div class="panel panel-profile">
        <div class="clearfix">
            <!-- LEFT COLUMN -->
            <div class="profile-left">
                <!-- PROFILE HEADER -->
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                        @if (strlen(auth()->user()->photo) > 0)
                            <img src="{{ asset('image/profile/' . auth()->user()->photo) }}" width="100px"
                                class="img-circle">
                        @else
                            <img src="{{ asset('image/profile/default.png') }}" width="100px" class="img-circle">
                        @endif
                        <h3 class="name">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</h3>
                        <span class="online-status status-available">Available</span>
                    </div>
                </div>
                <!-- END PROFILE HEADER -->
                <!-- PROFILE DETAIL -->
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4 class="heading">About</h4>
                        <ul class="list-unstyled list-justify">
                            <li>Username <span>{{ auth()->user()->username }}</span></li>
                            <li>Email <span>{{ auth()->user()->email }}</span></li>
                            <li>Phone <span>{{ auth()->user()->phone }}</span></li>
                            <li>Company <span>{{ auth()->user()->company->name }}</span></li>
                            <li>Departement <span>{{ auth()->user()->departement->name }}</span></li>
                        </ul>
                    </div>
                </div>
                <!-- END PROFILE DETAIL -->
            </div>
            <!-- END LEFT COLUMN -->
            <!-- RIGHT COLUMN -->
            <div class="profile-right">
                <h4 class="heading">
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ route('admin') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
                    @endif
                    @if (auth()->user()->role == 'user')
                        <a href="{{ route('user') }}" class=" badge"><i class="lnr lnr-arrow-left"></i> Back</a>
                    @endif
                </h4>
                <!-- TABBED CONTENT -->
                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                        <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Update Your Profile</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-bottom-left1">
                        <form method="POST" action="{{ route('profile.update', auth()->user()->username) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label sr-only">First Name</label>
                                        <input type="text"
                                            class="form-control input-sm @error('first_name') is-invalid @enderror"
                                            name="first_name" value="{{ auth()->user()->first_name }}" required
                                            autocomplete="first_name" autofocus id="first_name" placeholder="First Name">
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label sr-only">Last Name</label>
                                        <input type="text"
                                            class="form-control input-sm @error('last_name') is-invalid @enderror"
                                            name="last_name" value="{{ auth()->user()->last_name }}" required
                                            autocomplete="last_name" autofocus id="last_name" placeholder="Last Name">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="control-label sr-only">Username</label>
                                <input type="text" class="form-control input-sm @error('username') is-invalid @enderror"
                                    name="username" value="{{ auth()->user()->username }}" required
                                    autocomplete="username" autofocus id="username" placeholder="Username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">Email</label>
                                <input type="email" class="form-control input-sm @error('email') is-invalid @enderror"
                                    name="email" value="{{ auth()->user()->email }}" required autocomplete="email"
                                    autofocus id="signin-email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone" class="control-label sr-only">Phone</label>
                                <input id="phone" type="text"
                                    class="form-control input-sm @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ auth()->user()->phone }}" required placeholder="Phone" maxlength="13">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo" class="control-label sr-only">Photo</label>
                                <small>Photo Profile</small>
                                <input type="file" name="photo"
                                    class="form-control-file @error('phone') is-invalid @enderror" id="photo"
                                    value="{{ auth()->user()->photo }}">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (strlen(auth()->user()->photo) > 0)
                                    <img src="{{ asset('image/profile/' . auth()->user()->photo) }}" width="80px"
                                        class="mt-1">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                            <div class=" pull-right"> <a href="{{ route('profile.reset', auth()->user()->username) }}"
                                    class="btn btn-md btn-warning text-light">
                                    <i class="fa fa-lock"></i> Reset Password
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END TABBED CONTENT -->
            </div>
            <!-- END RIGHT COLUMN -->
        </div>
    </div>
@endsection
