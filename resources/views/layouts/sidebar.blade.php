<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('img/smooets_logo.jpg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <link rel="stylesheet" href="{{ asset('boxicons/box.css') }}">
        <span class="brand-text font-weight-light">Form Bast</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @can('dashboard-index')
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link {{ request()->is('*index*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endcan
                @can('user-index')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('*user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endcan
                @can('role-index')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}"
                            class="nav-link {{ request()->is('*roles*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Roles
                            </p>
                        </a>
                    </li>
                @endcan
                @can('project-index')
                    <li class="nav-item">
                        <a href="{{ route('project.index') }}"
                            class="nav-link {{ request()->is('*project*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Project
                            </p>
                        </a>
                    </li>
                @endcan
                @can('mom-index')
                    <li class="nav-item">
                        <a href="{{ route('mom.index') }}" class="nav-link {{ request()->is('*mom*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                MOM
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}"
                        class="nav-link {{ request()->is('*settings*') ? 'active' : '' }}">
                        <i class='nav-icon bx bx-cog'></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
