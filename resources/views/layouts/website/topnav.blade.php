<body>
    <div id="page-container" class="sidebar-dark side-scroll page-header-fixed page-header-dark main-content-boxed">
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="font-w600 text-dual" href="">
                    <span class="smini-visible">
                        <i class="fa fa-circle-notch text-primary"></i>
                    </span>
                    <span class="smini-hide font-size-h5 tracking-wider">
                    M R <span class="font-w400">Medicine Corner</span>
                    </span>
                </a>
                <div>
                    <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close"
                        href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll">
                <!-- Side Navigation -->
                <div class="content-side">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link active" href="/">
                                <i class="nav-main-link-icon si si-home"></i>
                                <span class="nav-main-link-name">Home</span>
                            </a>
                        </li>
                        @if(Auth::check())
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                aria-haspopup="true" aria-expanded="false" href="#">
                                <i class="nav-main-link-icon far fa-user"></i>
                                <span class="nav-main-link-name">Welcome {{ Auth::user()->name }}</span>
                            </a>
                            <ul class="nav-main-submenu nav-main-submenu-right">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{ route('dashboard') }}">
                                        <i class="nav-main-link-icon fa fa-th-large"></i>
                                        <span class="nav-main-link-name">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="">
                                        <i class="nav-main-link-icon fa fa-tools"></i>
                                        <span class="nav-main-link-name">Setting</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link"
                                        href="{{ route('logout') }}" 
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                                        <span class="nav-main-link-name">Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('login') }}">
                                <i class="nav-main-link-icon fa fa-sign-in-alt"></i>
                                <span class="nav-main-link-name">Login</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <a class="font-w600 font-size-h5 tracking-wider text-dual mr-3" href="">
                        M R <span class="font-w400">Medicine Corner</span>
                    </a>
                    <!-- END Logo -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-flex align-items-center">
                    <!-- Menu -->
                    <div class="d-none d-lg-block">
                        <ul class="nav-main nav-main-horizontal nav-main-hover">
                            <!-- <li class="nav-main-item">
                                <a class="nav-main-link active" href="/">
                                    <i class="nav-main-link-icon si si-home"></i>
                                    <span class="nav-main-link-name">Home</span>
                                </a>
                            </li> -->
                            <!-- <li class="nav-main-item">
                                <a class="nav-main-link" href="">
                                    <i class="nav-main-link-icon si si-wallet"></i>
                                    <span class="nav-main-link-name">Pricing</span>
                                </a>
                            </li> -->
                            <!-- <li class="nav-main-item">
                                <a class="nav-main-link" href="">
                                    <i class="nav-main-link-icon si si-envelope"></i>
                                    <span class="nav-main-link-name">Contact</span>
                                </a>
                            </li> -->
                            @if(Auth::check())
                            <li class="nav-main-item">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                    aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon far fa-user"></i>
                                    <span class="nav-main-link-name">Welcome {{ Auth::user()->name }}</span>
                                </a>
                                <ul class="nav-main-submenu nav-main-submenu-right">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="{{ route('dashboard') }}">
                                            <i class="nav-main-link-icon fa fa-th-large"></i>
                                            <span class="nav-main-link-name">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link" href="{{ route('pospage') }}">
                                            <i class="nav-main-link-icon fa fa-tools"></i>
                                            <span class="nav-main-link-name">Point Of Sale</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link"
                                            href="{{ route('logout') }}" 
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                                            <span class="nav-main-link-name">Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('login') }}">
                                    <i class="nav-main-link-icon fa fa-sign-in-alt"></i>
                                    <span class="nav-main-link-name">Login</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- END Menu -->

                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-dual d-lg-none ml-1" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-white">
                <div class="content-header">
                    <form class="w-100" method="POST">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-alt-danger" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fa fa-fw fa-times-circle"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary-lighter">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->