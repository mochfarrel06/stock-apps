@extends('manajer.layouts.master')

@section('title-page')
    Laporan Barang Masuk
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Halaman Laporan Barang Masuk</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('manajer.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Laporan Barang Masuk</li>
                </ol>
            </nav>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Filter Data Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('manajer.incoming-report.index') }}" method="GET">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Awal</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ request('start_date') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Akhir</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ request('end_date') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary mr-2 mb-2">Tampilkan Data</button>
                                <a href="{{ route('manajer.incoming-report.exportPdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                                    class="btn btn-warning mr-2 mb-2"><i class="fas fa-solid fa-file-pdf"></i> Export
                                    PDF</a>
                                <a href="{{ route('manajer.incoming-report.exportExcel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                                    class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">Table Laporan Data Barang Masuk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Barang Masuk</th>
                                <th>Jumlah Barang Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomingItems as $incomingItem)
                                <tr>
                                    <td class="index">{{ $loop->index + 1 }}</td>
                                    <td>{{ $incomingItem->item->item_code ?? '' }}</td>
                                    <td>{{ $incomingItem->item->name ?? '' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td>{{ $incomingItem->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
