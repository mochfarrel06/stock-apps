<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('gudang.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">codeFa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('gudang.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('gudang.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ request()->routeIs('gudang.item*') || request()->routeIs('gudang.item-type*') || request()->routeIs('gudang.unit-type*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-box"></i>
            <span>Barang</span>
        </a>
        <div id="collapseTwo"
            class="collapse {{ request()->routeIs('gudang.item*') || request()->routeIs('gudang.item-type*') || request()->routeIs('gudang.unit-type*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Barang</h6>
                <a class="collapse-item {{ request()->routeIs('gudang.item.*') ? 'active' : '' }}"
                    href="{{ route('gudang.item.index') }}">Data Barang</a>
                <a class="collapse-item {{ request()->routeIs('gudang.item-type.*') ? 'active' : '' }}"
                    href="{{ route('gudang.item-type.index') }}">Jenis Barang</a>
                <a class="collapse-item {{ request()->routeIs('gudang.unit-type.*') ? 'active' : '' }}"
                    href="{{ route('gudang.unit-type.index') }}">Satuan Barang</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ request()->routeIs('gudang.incoming-item*') || request()->routeIs('gudang.outgoing-item*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapsePages"
            class="collapse {{ request()->routeIs('gudang.incoming-item*') || request()->routeIs('gudang.outgoing-item*') ? 'show' : '' }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item {{ request()->routeIs('gudang.incoming-item.*') ? 'active' : '' }}"
                    href="{{ route('gudang.incoming-item.index') }}">Barang Masuk</a>
                <a class="collapse-item {{ request()->routeIs('gudang.outgoing-item*') ? 'active' : '' }}"
                    href="{{ route('gudang.outgoing-item.index') }}">Barang Keluar</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('gudang.item-report.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-solid fa-file"></i>
            <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse {{ request()->routeIs('gudang.item-report.index') ? 'show' : '' }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item {{ request()->routeIs('gudang.item-report.index') ? 'active' : '' }}"
                    href="{{ route('gudang.item-report.index') }}">Laporan Data Barang</a>
                {{-- <a class="collapse-item {{ request()->routeIs('gudang.outgoing-item*') ? 'active' : '' }}"
                    href="{{ route('gudang.outgoing-item.index') }}">Barang Keluar</a> --}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
