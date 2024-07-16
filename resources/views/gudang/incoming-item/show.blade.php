@extends('gudang.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lihat Barang Masuk</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.incoming-item.index') }}">Barang Masuk</a></li>
                    <li class="breadcrumb-item">Lihat</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lihat Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label>Data Barang <span class="text-danger">(Kode Barang - Nama
                                        Barang)</span></label>
                                <input type="text" class="form-control"
                                    value="{{ $item->item_code }} - {{ $item->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Barang Masuk</span></label>
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label>Jumlah Barang Masuk</span></label>
                                <input type="number" class="form-control" value="{{ $incomingItem->quantity }}" disabled>
                            </div>

                            <a href="{{ route('gudang.incoming-item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
