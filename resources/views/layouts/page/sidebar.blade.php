<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                @if (Auth::user()->role == 'admin')
                    <li><a href="{{ route('admin') }}" class="{{ request()->is('admin') ? ' active' : '' }}"><i
                                class="lnr lnr-home"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li><a href="{{ route('companies.index') }}"
                            class="{{ request()->is('companies') ? ' active' : '' }}"><i
                                class="lnr lnr-apartment"></i>
                            <span>Companies</span></a></li>
                    <li><a href="{{ route('departements.index') }}"
                            class="{{ request()->is('departements') ? ' active' : '' }}"><i
                                class="lnr lnr-license"></i>
                            <span>Departements</span></a></li>
                    <li><a href="{{ route('employees.index') }}"
                            class="{{ request()->is('employees') ? ' active' : '' }}"><i class="lnr lnr-users"></i>
                            <span>Employees</span></a></li>
                @endif
                @if (Auth::user()->role == 'user')
                    <li><a href="{{ route('user') }}" class="{{ request()->is('user') ? ' active' : '' }}"><i
                                class="lnr lnr-home"></i>
                            <span>Dashboard</span></a>
                    </li>
                @endif
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cog"></i>
                        <span>Settings</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{ route('profile') }}" class="">Profile</a></li>
                        </ul>
                        @if (Auth::user()->role == 'admin')
                            <ul class="nav">
                                <li><a href="{{ route('cleaner') }}" class="">Cleaner</a></li>
                            </ul>
                        @endif
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
