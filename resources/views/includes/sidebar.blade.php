<!-- sidebar-->
<aside class="aside-container">
    <!-- START Sidebar (left)-->
    <div class="aside-inner">
        <nav class="sidebar" data-sidebar-anyclick-close="">
            <!-- START sidebar nav-->
            <ul class="sidebar-nav">
                <!-- START user info-->
                {{--<li class="has-user-block">
                    <div class="show" id="user-block">
                        <div class="item user-block">
                            <!-- User picture-->
                            <div class="user-block-picture">
                                <div class="user-block-status">
                                    <img class="img-thumbnail rounded-circle" src="{{asset('angleadmin/img/user/02.jpg')}}" alt="Avatar" width="60" height="60">
                                    <div class="circle bg-success circle-lg"></div>
                                </div>
                            </div>
                            <!-- Name and Job-->
                            <div class="user-block-info">
                                <span class="user-block-name">Hello, Mike</span>
                                <span class="user-block-role">Designer</span>
                            </div>
                        </div>
                    </div>
                </li>--}}
                <!-- END user info-->
                <!-- Iterates over all sidebar items-->
                <li class="nav-heading ">
                    <span data-localize="sidebar.heading.HEADER">Main Navigation</span>
                </li>
                <li class=" ">
                    <a href="{{route('home')}}" title="Dashboard">
                        <em class="icon-speedometer"></em>
                        <span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
                    </a>
                </li>
                <li class=" ">
                    <a href="{{route('consultation.index')}}" title="Consultation">
                        <em class="icon-graph"></em>
                        <span data-localize="sidebar.nav.CONSULTATION">Consultation</span>
                    </a>
                </li>
                <li class=" ">
                    <a href="#manage" title="Manage" data-toggle="collapse">
                        <em class="icon-grid"></em>
                        <span data-localize="sidebar.nav.MANAGE">Manage</span>
                    </a>
                    <ul class="sidebar-nav sidebar-subnav collapse" id="manage">
                        <li class="sidebar-subnav-header">Manage</li>
                        <li>
                            <a href="{{ route('urt.index') }}" title="Ukuran Rumah Tangga">
                                <span>URT</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{ route('food-ingredient-category.index') }}" title="Food Ingredient Category">
                                <span>Food Ingredient Category</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{ route('food-ingredient.index') }}" title="Food Ingredient">
                                <span>Food Ingredient</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{ route('menu.index') }}" title="Menu">
                                <span>Menu</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{ route('user.index') }}" title="User">
                                <span>User</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{ route('admin.index') }}" title="Admin">
                                <span>Admin</span>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="{{ route('article.index') }}" title="Article">
                                <span>Article</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END sidebar nav-->
        </nav>
    </div>
    <!-- END Sidebar (left)-->
</aside>