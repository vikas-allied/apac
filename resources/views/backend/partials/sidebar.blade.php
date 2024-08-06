<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">

        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link"> <!--begin::Brand Image-->
            <img src="{{ url('backend/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->

            <!--begin::Brand Text-->
                <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Str::contains(Route::currentRouteName(), 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Str::contains(Route::currentRouteName(), 'roles.index') ? 'active' : '' }}">--}}
{{--                        <i class="nav-icon bi bi-speedometer"></i>--}}
{{--                        <p>Roles</p>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="nav-header text-uppercase">
                    <p>System Management</p>
                </li>
                <li class="nav-item {{ Str::contains(Route::currentRouteName(), [ 'roles', 'users']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Str::contains(Route::currentRouteName(), [ 'roles', 'users']) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-sliders"></i>
                        <p>
                            User Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" >
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Str::contains(Route::currentRouteName(), 'roles') ? 'active' : '' }}">
                                <i class="bi bi-person-fill-gear"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        @can('manage_user')
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Str::contains(Route::currentRouteName(), 'users') ? 'active' : '' }}">
                                <i class="bi bi-people"></i>
                                <p>Admin Users</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>

