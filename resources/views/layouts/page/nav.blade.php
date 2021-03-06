<!-- NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        @if (auth()->user()->role == 'admin')
            <a href="{{ route('admin') }}"><img src="{{ asset('assets/img/logo-dark.png') }}" alt="Klorofil Logo"
                    class="img-responsive logo"></a>
        @endif
        @if (auth()->user()->role == 'user')
            <a href="{{ route('user') }}"><img src="{{ asset('assets/img/logo-dark.png') }}" alt="Klorofil Logo"
                    class="img-responsive logo"></a>
        @endif
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>

        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    @if (strlen(auth()->user()->photo) > 0)
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                                src="{{ asset('image/profile/' . auth()->user()->photo) }}" class="img-circle">
                            <span>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span> <i
                                class="icon-submenu lnr lnr-chevron-down"></i></a>
                    @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                                src="{{ asset('image/profile/default.png') }}" class="img-circle">
                            <span>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span> <i
                                class="icon-submenu lnr lnr-chevron-down"></i></a>
                    @endif
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('profile') }}"><i class="lnr lnr-user"></i> <span>My Profile</span></a>
                        </li>
                        {{-- <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                        <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="lnr lnr-exit"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
