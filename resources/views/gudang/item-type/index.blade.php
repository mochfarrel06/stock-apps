@extends('gudang.layouts.master')

@section('title-page')
    Jenis Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Jenis Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('gudang.dashboard')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Jenis Barang'" :icon="'fas fa-cube'" :addRoute="'gudang.item-type.create'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Jenis Barang', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($itemTypes as $itemType)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $itemType->name ?? '' }}</td>
                            <td>
                                <a href="{{ route('gudang.item-type.show', $itemType->id) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('gudang.item-type.edit', $itemType->id) }}"
                                    class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('gudang.item-type.destroy', $itemType->id) }}"
                                    class="btn btn-danger mr-2 mb-2 delete-item"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
