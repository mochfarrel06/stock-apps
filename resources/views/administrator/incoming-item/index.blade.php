@extends('administrator.layouts.master')

@section('title-page')
    Barang Masuk
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Barang Masuk'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('admin.dashboard')], ['title' => 'Barang Masuk']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Barang Masuk'" :icon="'fas fa-download'" :addRoute="'admin.incoming-item.create'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Kode Barang', 'Nama Barang', 'Tanggal', 'Jumlah', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($incomingItems as $incomingItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $incomingItem->item->item_code }}</td>
                            <td>{{ $incomingItem->item->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>{{ $incomingItem->quantity }}</td>
                            <td>
                                <a href="{{ route('admin.incoming-item.show', $incomingItem->id) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.incoming-item.destroy', $incomingItem->id) }}"
                                    class="btn btn-danger mr-2 mb-2 delete-item"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
