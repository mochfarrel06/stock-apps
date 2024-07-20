@extends('gudang.layouts.master')

@section('title-page')
    Laporan Data Barang
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Halaman Laporan Data Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item">Laporan Data Barang</li>
                </ol>
            </nav>
        </div>

        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Filter Data Stok Barang</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('gudang.item-report.index') }}" method="GET">
                            @csrf

                            <div class="col-md-6 p-0">
                                <div class="form-group">
                                    <label for="filter">Filter Stok Barang</label>
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="">-- Pilih Stok Barang --</option>
                                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua Data
                                            Stok</option>
                                        <option value="minimum" {{ request('filter') == 'minimum' ? 'selected' : '' }}>Stok
                                            Minimum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary mr-2 mb-2">Tampilkan Data</button>

                                <a href="{{ route('gudang.item-report.exportPdf', ['filter' => request('filter')]) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-solid fa-file-pdf"></i> Export
                                    Data</a>

                                <a href="{{ route('gudang.item-report.exportExcel', ['filter' => request('filter')]) }}"
                                    class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">Table Laporan Data Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Stok</th>
                                <th>Stok Minimum</th>
                                <th>Harga</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="index">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->stock ?? '' }}</td>
                                    <td>{{ $item->reorder_level ?? '' }}</td>
                                    <td>Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $item->unitType->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
