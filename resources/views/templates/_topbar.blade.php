<!-- .topbar-->
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <span class="p-l-10">SR</span>
            </a>

            <!-- Toggle which is visible on mobile only -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- /.navbar-header -->

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- toggle and nav items -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                <!-- Create New -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                        <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.singles.create') }}">Single</a>
                        <a class="dropdown-item" href="{{ route('admin.albums.create') }}">Album</a>
                        <a class="dropdown-item" href="{{ route('admin.stems.create') }}">Stem</a>
                    </div>
                </li>
                <!-- End Create New -->
            </ul>

            <!-- Right side toggle and nav items -->
            <ul class="navbar-nav float-right">
                <!-- User profile and search -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->full_name() }}" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{ route('admin.users.show', auth()->user()) }}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i>{{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- User profile and search -->
            </ul>
        </div>
    </nav>
</header>
<!-- End Top Bar-->
