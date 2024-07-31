<!-- Sidebar -->
<x-sidebar.layout>

    <!-- Sidebar title -->
    <x-sidebar.title :name="'codeFa'" :icon="'fas fa-solid fa-book'" :addRoute="'manajer.dashboard'" />
    <!-- End sidebar title -->

    <!-- Nav item dashboard -->
    <x-sidebar.nav-item route="manajer.dashboard" icon="fa-tachometer-alt" label="Dashboard" />
    <!-- End nav item dashboard -->

    <!-- Nav item barang -->
    <x-sidebar.nav-item title="Master" icon="fa-box" label="Barang" collapseId="collapseItem" :routes="['manajer.item.*', 'manajer.item-type.*', 'manajer.unit-type.*']"
        :subItems="[
            ['route' => 'manajer.item.index', 'label' => 'Data Barang'],
            ['route' => 'manajer.item-type.index', 'label' => 'Jenis Barang'],
            ['route' => 'manajer.unit-type.index', 'label' => 'Satuan Barang'],
        ]" />
    <!-- End nav item -->

    <!-- Nav item incoming item -->
    <x-sidebar.nav-item title="Transaksi" icon="fa-folder" label="Transaksi" collapseId="collapsePages" :routes="['manajer.incoming-item.*', 'manajer.outgoing-item.*']"
        :subItems="[
            ['route' => 'manajer.incoming-item.index', 'label' => 'Barang Masuk'],
            ['route' => 'manajer.outgoing-item.index', 'label' => 'Barang Keluar'],
        ]" />
    <!-- End nav item incoming item -->

    <!-- Nav item report -->
    <x-sidebar.nav-item title="Laporan" icon="fa-wrench" label="Laporan" collapseId="collapseReport" :routes="['manajer.item-report.*', 'manajer.incoming-report.*', 'manajer.outgoing-report.*']"
        :subItems="[
            ['route' => 'manajer.item-report.index', 'label' => 'Laporan Data Barang'],
            ['route' => 'manajer.incoming-report.index', 'label' => 'Laporan Barang Masuk'],
            ['route' => 'manajer.outgoing-report.index', 'label' => 'Laporan Barang Keluar'],
        ]" />
    <!-- End nav item report -->

</x-sidebar.layout>
<!-- End of Sidebar -->
