<x-sidebar.layout>
    <!-- Start sidebar title -->
    <x-sidebar.title :name="'codeFa'" :icon="'fas fa-solid fa-book'" :addRoute="'gudang.dashboard'" />
    <!-- End sidebar title -->

    <!-- Nav item dashboard -->
    <x-sidebar.nav-item route="gudang.dashboard" icon="fa-tachometer-alt" label="Dashboard" />
    <!-- End nav item dashboard -->

    <!-- Nav item barang -->
    <x-sidebar.nav-item title="Master" icon="fa-box" label="Barang" collapseId="collapseItem" :routes="['gudang.item.*', 'gudang.item-type.*', 'gudang.unit-type.*']"
        :subItems="[
            ['route' => 'gudang.item.index', 'label' => 'Data Barang'],
            ['route' => 'gudang.item-type.index', 'label' => 'Jenis Barang'],
            ['route' => 'gudang.unit-type.index', 'label' => 'Satuan Barang'],
        ]" />
    <!-- End nav item -->

    <!-- Nav item incoming item -->
    <x-sidebar.nav-item title="Transaksi" icon="fa-folder" label="Transaksi" collapseId="collapsePages" :routes="['gudang.incoming-item.*', 'gudang.outgoing-item.*']"
        :subItems="[
            ['route' => 'gudang.incoming-item.index', 'label' => 'Barang Masuk'],
            ['route' => 'gudang.outgoing-item.index', 'label' => 'Barang Keluar'],
        ]" />
    <!-- End nav item incoming item -->

    <!-- Nav item report -->
    <x-sidebar.nav-item title="Laporan" icon="fa-wrench" label="Laporan" collapseId="collapseReport" :routes="['gudang.item-report.*', 'gudang.incoming-report.*', 'gudang.outgoing-report.*']"
        :subItems="[
            ['route' => 'gudang.item-report.index', 'label' => 'Laporan Data Barang'],
            ['route' => 'gudang.incoming-report.index', 'label' => 'Laporan Barang Masuk'],
            ['route' => 'gudang.outgoing-report.index', 'label' => 'Laporan Barang Keluar'],
        ]" />
    <!-- End nav item report -->
</x-sidebar.layout>
