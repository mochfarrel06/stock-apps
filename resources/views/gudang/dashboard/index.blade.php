@extends('gudang.layouts.master')

@section('title-page')
    Gudang
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-900">Halaman Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            @foreach ($cards as $card)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-{{ $card['bg_color'] }} shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-{{ $card['bg_color'] }} text-uppercase mb-1">
                                        {{ $card['title'] }}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $card['value'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="{{ $card['icon'] }} fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-circle-exclamation"></i> Table stok barang
                    minimum</h6>
            </div>
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
