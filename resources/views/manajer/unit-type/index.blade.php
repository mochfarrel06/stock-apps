@extends('manajer.layouts.master')

@section('title-page')
    Satuan Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Satuan Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('manajer.dashboard')], ['title' => 'Satuan Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Satuan Barang'" :icon="'fas fa-folder'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Satuan Barang', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($unitTypes as $unitType)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $unitType->name ?? '' }}</td>
                            <td>
                                <a href="{{ route('manajer.unit-type.show', $unitType->id) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
