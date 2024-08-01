@extends('administrator.layouts.master')

@section('title-page')
    Data Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Data Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('admin.dashboard')], ['title' => 'Data Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Data Barang'" :icon="'fas fa-box'" :addRoute="'admin.item.create'" />

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
                        ]" :actions="[
                            ['route' => 'admin.item.show', 'class' => 'warning', 'icon' => 'fas fa-eye'],
                            ['route' => 'admin.item.edit', 'class' => 'success', 'icon' => 'fas fa-edit'],
                            [
                                'route' => 'admin.item.destroy',
                                'class' => 'danger delete-item',
                                'icon' => 'fas fa-trash',
                            ],
                        ]" />
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>
    </x-content.container-fluid>
@endsection
