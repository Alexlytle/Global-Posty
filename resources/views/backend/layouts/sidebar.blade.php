<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav ">
            <li class="nav-item {{ request()->is('subcategory') ? 'active' : '' }} ">
                <a class="nav-link" href="/dashboard/admin">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#auth1" aria-expanded="false" aria-controls="auth">
                    <i class="mdi mdi-circle-outline menu-icon"></i>
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth1">
                    <ul class="nav flex-column sub-menu">
                       
                        <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Manage</a></li>
                    </ul>
                </div>
            </li>
       
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth">
                    <i class="mdi mdi-circle-outline menu-icon"></i>
                    <span class="menu-title">Blocked Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth2">
                    <ul class="nav flex-column sub-menu">
                       
                        <li class="nav-item"> <a class="nav-link" href="{{ route('blocked.index') }}">Manage</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#auth3" aria-expanded="false" aria-controls="auth">
                    <i class="mdi mdi-circle-outline menu-icon"></i>
                    <span class="menu-title">Reported Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth3">
                    <ul class="nav flex-column sub-menu">
                       
                        <li class="nav-item"> <a class="nav-link" href="{{ route('spam.index') }}">Manage</a></li>
                    </ul>
                </div>
            </li>
       
        </ul>
    </nav>
