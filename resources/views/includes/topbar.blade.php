<!-- top navbar-->
<header class="topnavbar-wrapper">
    <!-- START Top Navbar-->
    <nav class="navbar topnavbar" role="navigation">
        <!-- START navbar header-->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <div class="brand-logo">
                    {{--<img class="img-fluid" src="{{asset('angleadmin/img/logo.html')}}" alt="App Logo">--}}
                    <b class="text-white">SmartNutri</b>
                </div>
                <div class="brand-logo-collapsed">
                    <img class="img-fluid" src="{{asset('angleadmin/img/logo-single.png')}}" alt="App Logo">
                </div>
            </a>
        </div>
        <!-- END navbar header-->
        <!-- START Left navbar-->
        <ul class="navbar-nav mr-auto flex-row">
            <li class="nav-item">
                <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                <a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
                    <em class="fa fa-navicon"></em>
                </a>
                <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                <a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
                    <em class="fa fa-navicon"></em>
                </a>
            </li>
        </ul>
        <!-- END Left navbar-->
        <!-- START Right Navbar-->
        <ul class="navbar-nav flex-row">
            <!-- START Alert menu-->
            <li class="nav-item dropdown dropdown-list">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-toggle="dropdown">
                    <em class="icon-user"></em>
                </a>
                <!-- START Dropdown menu-->
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item">
                        <!-- START list group-->
                        <div class="list-group">
                            <!-- list item-->
                            <div class="list-group-item list-group-item-action">
                                <a href="{{ route('profile') }}" style="text-decoration: none">
                                    <div class="media">
                                        <div class="align-self-start mr-2">
                                            <em class="fa fa-user"></em>
                                        </div>
                                        <div class="media-body">
                                            <p class="m-0">Profile</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <a href="javascript:void(0)" style="text-decoration: none" onclick="$('#logout-form').submit();">
                                    <div class="media">
                                        <div class="align-self-start mr-2">
                                            <em class="fa fa-close"></em>
                                        </div>
                                        <div class="media-body">
                                            <p class="m-0">Logout</p>
                                        </div>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <!-- END list group-->
                    </div>
                </div>
                <!-- END Dropdown menu-->
            </li>
            <!-- END Alert menu-->
        </ul>
    </nav>
    <!-- END Top Navbar-->
</header>