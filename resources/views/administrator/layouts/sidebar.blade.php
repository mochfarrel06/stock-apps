<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar title -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">codeFa</div>
    </a>
    <!-- End sidebar title -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- End divider -->

    <!-- Nav item dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- End nav item dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- End divider -->

    <!-- Heading master -->
    <div class="sidebar-heading">
        Master
    </div>
    <!-- End heading master -->

    <!-- Nav item barang -->
    {{-- <li
        class="nav-item {{ request()->routeIs('gudang.item.*') || request()->routeIs('gudang.item-type.*') || request()->routeIs('gudang.unit-type.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseItem" aria-expanded="true"
            aria-controls="collapseItem">
            <i class="fas fa-box"></i>
            <span>Barang</span>
        </a>
        <div id="collapseItem"
            class="collapse {{ request()->routeIs('gudang.item.*') || request()->routeIs('gudang.item-type.*') || request()->routeIs('gudang.unit-type.*') ? 'show' : '' }}"
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
    </li> --}}

    <li
        class="nav-item {{ request()->routeIs('admin.item.*') || request()->routeIs('admin.item-type.*') || request()->routeIs('admin.unit-type.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseItem" aria-expanded="true"
            aria-controls="collapseItem">
            <i class="fas fa-box"></i>
            <span>Barang</span>
        </a>
        <div id="collapseItem"
            class="collapse {{ request()->routeIs('admin.item.*') || request()->routeIs('admin.item-type.*') || request()->routeIs('admin.unit-type.*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Barang</h6>
                <a class="collapse-item {{ request()->routeIs('admin.item.*') ? 'active' : '' }}"
                    href="{{ route('admin.item.index') }}">Data Barang</a>
                <a class="collapse-item {{ request()->routeIs('admin.item-type.*') ? 'active' : '' }}"
                    href="{{ route('admin.item-type.index') }}">Jenis Barang</a>
                <a class="collapse-item {{ request()->routeIs('admin.unit-type.*') ? 'active' : '' }}"
                    href="{{ route('admin.unit-type.index') }}">Satuan Barang</a>
            </div>
        </div>
    </li>
    <!-- End nav item -->

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- End divider -->

    <!-- Heading transaksi -->
    <div class="sidebar-heading">
        Transaksi
    </div>
    <!-- End heading transksi -->

    <!-- Nav item incoming item -->
    {{-- <li
        class="nav-item {{ request()->routeIs('gudang.incoming-item.*') || request()->routeIs('gudang.outgoing-item.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapsePages"
            class="collapse {{ request()->routeIs('gudang.incoming-item.*') || request()->routeIs('gudang.outgoing-item.*') ? 'show' : '' }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item {{ request()->routeIs('gudang.incoming-item.*') ? 'active' : '' }}"
                    href="{{ route('gudang.incoming-item.index') }}">Barang Masuk</a>
                <a class="collapse-item {{ request()->routeIs('gudang.outgoing-item.*') ? 'active' : '' }}"
                    href="{{ route('gudang.outgoing-item.index') }}">Barang Keluar</a>
            </div>
        </div>
    </li> --}}
    <!-- End nav item incoming item -->

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- End divider -->

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>
    <!-- End heading -->

    <!-- Nav item report -->
    {{-- <li
        class="nav-item {{ request()->routeIs('gudang.item-report.*') || request()->routeIs('gudang.incoming-report.*') || request()->routeIs('gudang.outgoing-report.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseReport"
            aria-expanded="true" aria-controls="collapseReport">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseReport"
            class="collapse {{ request()->routeIs('gudang.item-report.*') || request()->routeIs('gudang.incoming-report.*') || request()->routeIs('gudang.outgoing-report.*') ? 'show' : '' }}"
            aria-labelledby="headingReport" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item {{ request()->routeIs('gudang.item-report.*') ? 'active' : '' }}"
                    href="{{ route('gudang.item-report.index') }}">Laporan Data Barang</a>
                <a class="collapse-item {{ request()->routeIs('gudang.incoming-report.*') ? 'active' : '' }}"
                    href="{{ route('gudang.incoming-report.index') }}">Laporan Barang Masuk</a>
                <a class="collapse-item {{ request()->routeIs('gudang.outgoing-report.*') ? 'active' : '' }}"
                    href="{{ route('gudang.outgoing-report.index') }}">Laporan Barang Keluar</a>
            </div>
        </div>
    </li> --}}
    <!-- End nav item report -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
