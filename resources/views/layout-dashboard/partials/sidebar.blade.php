<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">SI-DATA</span>
        <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
            class="nav sidebar-menu flex-column"
            data-lte-toggle="treeview"
            role="navigation"
            aria-label="Main navigation"
            data-accordion="false"
            id="navigation"
        >
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-palette"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.users') }}"
                    class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-clipboard-fill"></i>
                    <p>Users</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.category') }}"
                    class="nav-link {{ request()->routeIs('admin.category') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-box-seam-fill"></i>
                    <p>Category</p>
                </a>
            </li>
        </ul>
        <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
    </aside>