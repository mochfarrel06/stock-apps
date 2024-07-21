@extends('manajer.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Lihat Barang Keluar</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('manajer.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('manajer.outgoing-item.index') }}">Barang Keluar</a></li>
                    <li class="breadcrumb-item">Lihat</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Barang Keluar</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" value="{{ $item->item_code }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Barang Keluar</span></label>
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($outgoingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label>Jumlah Barang Keluar</span></label>
                                <input type="number" class="form-control" value="{{ $outgoingItem->quantity }}" disabled>
                            </div>

                            <a href="{{ route('manajer.outgoing-item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
