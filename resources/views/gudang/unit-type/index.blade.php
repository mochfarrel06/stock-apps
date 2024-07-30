@extends('gudang.layouts.master')

@section('title-page')
    Satuan Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Satuan Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('gudang.dashboard')], ['title' => 'Satuan Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Satuan Barang'" :icon="'fas fa-folder'" :addRoute="'gudang.unit-type.create'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Satuan Barang', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($unitTypes as $unitType)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $unitType->name ?? '' }}</td>
                            <td>
                                <a href="{{ route('gudang.unit-type.show', $unitType->id) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('gudang.unit-type.edit', $unitType->id) }}"
                                    class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('gudang.unit-type.destroy', $unitType->id) }}"
                                    class="btn btn-danger mr-2 mb-2 delete-item"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
