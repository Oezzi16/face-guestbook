<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
<!--begin::Sidebar Brand-->
<div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="/" class="brand-link">
    
    <!--begin::Brand Text-->
    <span class="brand-text fw-light">BUKU TAMU</span>
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
        role="menu"
        data-accordion="false"
    >
        
        <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('admin.guests.index') }}" class="nav-link">
            <i class="nav-icon bi bi-table"></i>
            <p>Daftar Tamu</p>
        </a>
        </li>

    
       
       
    </ul>
    <!--end::Sidebar Menu-->
    </nav>
</div>
<!--end::Sidebar Wrapper-->
</aside>