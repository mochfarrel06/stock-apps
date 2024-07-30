@extends('manajer.layouts.master')

@section('title-page')
    Data Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Data Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('manajer.dashboard')], ['title' => 'Data Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Data Barang'" :icon="'fas fa-box'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Kode Barang', 'Nama Barang', 'Stok', 'Jenis Barang', 'Satuan', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($items as $item)
                        <x-content.table-row :index="$loop->index + 1" :item="$item" :columns="[
                            $item->item_code,
                            $item->name,
                            $item->stock,
                            $item->itemType->name,
                            $item->unitType->name,
                        ]" :actions="[['route' => 'manajer.item.show', 'class' => 'warning', 'icon' => 'fas fa-eye']]" />
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>
    </x-content.container-fluid>
@endsection
