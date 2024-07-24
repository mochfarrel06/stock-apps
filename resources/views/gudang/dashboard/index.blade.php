@extends('gudang.layouts.master')

@section('title-page')
    Gudang
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <x-heading-page title="Halaman Data Barang" />

        <!-- Content Row -->
        <div class="row">
            @foreach ($cards as $card)
                <x-card-dashboard :title="$card['title']" :bgColor="$card['bg_color']" :value="$card['value']" :icon="$card['icon']" />
            @endforeach
        </div>

        <div class="card shadow mb-4 mt-4">

            <x-table-header :title="'Tabel Data Barang Minimum'" :icon="'fas fa-circle-exclamation'" />

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="index">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->item_code ?? '' }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->itemType->name ?? '' }}</td>
                                    <td>{{ $item->unitType->name ?? '' }}</td>
                                    <td>
                                        <a class="btn btn-danger">{{ $item->stock }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
