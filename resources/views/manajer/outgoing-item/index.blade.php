@extends('manajer.layouts.master')

@section('title-page')
    Barang Keluar
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Barang Keluar'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('manajer.dashboard')], ['title' => 'Barang Keluar']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Barang Keluar'" :icon="'fas fa-upload'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Kode Barang', 'Nama Barang', 'Tanggal', 'Jumlah', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($outgoingItems as $outgoingItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $outgoingItem->item->item_code }}</td>
                            <td>{{ $outgoingItem->item->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($outgoingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>{{ $outgoingItem->quantity ?? '' }}</td>
                            <td>
                                <a href="{{ route('manajer.outgoing-item.show', $outgoingItem->id) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
