@extends('manajer.layouts.master')

@section('title-page')
    Jenis Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Jenis Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('manajer.dashboard')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Jenis Barang'" :icon="'fas fa-cube'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Jenis Barang', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($itemTypes as $itemType)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $itemType->name ?? '' }}</td>
                            <td>
                                <a href="{{ route('manajer.item-type.show', $itemType->id) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>
    </x-content.container-fluid>
@endsection
