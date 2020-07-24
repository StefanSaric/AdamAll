<!-- BEGIN SIDEBAR-->
<div id="sidebar">
    <div class="sidebar-back"></div>
    <div class="sidebar-content">
        <div class="nav-brand">
            <a class="main-brand" href="{{ asset("/html/dashboards/dashboard.html")}}">
                <h3 class="text-light text-white"><span>Boost<strong>Box</strong> </span><i class="fa fa-rocket fa-fw"></i></h3>
            </a>
        </div>

        <!-- BEGIN MENU SEARCH -->
        <form class="sidebar-search" role="search">
            <a href="javascript:void(0);"><i class="fa fa-search fa-fw search-icon"></i><i class="fa fa-angle-left fa-fw close-icon"></i></a>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control navbar-input" placeholder="Search...">
                    <span class="input-group-btn">
									<button class="btn btn-equal" type="button"><i class="fa fa-search"></i></button>
								</span>
                </div>
            </div>
        </form>
        <!-- END MENU SEARCH -->
        <!-- BEGIN MAIN MENU -->
        <ul class="main-menu">
            <!-- Menu Dashboard -->
            <li>
                <a href="{{ url('/admin')}}" >
                    <i class="fa fa-home fa-fw"></i><span class="title">Dashboard</span>
                </a>
            </li><!--end /menu-item -->
            <!-- Menu UI -->
            @if(Auth::user()->hasRole('admin'))
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-user fa-fw"></i><span class="title">Users</span> <span class="expand-sign">+</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin\users') }}" >All Users</a></li>
                    <li><a href="{{ url('admin\users\create')}}" >Create User</a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-item -->
            @endif
            @if(Auth::user()->hasRole('admin'))
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-sort fa-fw"></i><span class="title">Roles</span> <span class="expand-sign">+</span>
                </a>
                <ul>
                    <li><a href="{{ url('admin\roles') }}" >All Roles</a></li>
                    <li><a href="{{ url('admin\roles\create')}}" >Create Role</a></li>
                </ul>
            </li>
            @endif
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-paperclip fa-fw"></i><span class="title">Posts</span> <span class="expand-sign">+</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin\posts') }}" >All Posts</a></li>
                    <li><a href="{{ url('admin\posts\create')}}" >Create Post</a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-item -->
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-adn fa-fw"></i><span class="title">Ads</span> <span class="expand-sign">+</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin\ads') }}" >All Ads</a></li>
                    <li><a href="{{ url('admin\ads\create')}}" >Create Ad</a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-item -->
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-pencil fa-fw"></i><span class="title">News</span> <span class="expand-sign">+</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin\news') }}" >All News</a></li>
                    <li><a href="{{ url('admin\news\create')}}" >Create News</a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-item -->
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-comment fa-fw"></i><span class="title">Commercials</span> <span class="expand-sign">+</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin\commercials') }}" >All Commercials</a></li>
                    <li><a href="{{ url('admin\commercials\create')}}" >Create Commercials</a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-item -->
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-mail-forward fa-fw"></i><span class="title">Registrations</span> <span class="expand-sign">+</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin\registrations') }}" >All Registrations</a></li>
                    <li><a href="{{ url('admin\registrations\create')}}" >Create Registration</a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-item -->
            <!-- Menu Pages -->
        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

    </div>
</div><!--end #sidebar-->
<!-- END SIDEBAR -->


