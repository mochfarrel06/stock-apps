@extends('gudang.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lihat Data Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Data Barang</a></li>
                    <li class="breadcrumb-item">Lihat</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <!-- Gambar Produk -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        @if ($item->photo)
                            <img src="{{ asset($item->photo) }}" alt="Location Image" class="img-fluid rounded" />
                        @else
                            <p>Tidak ada gambar yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <!-- Informasi Produk -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label for="item_code">Kode Barang</label>
                                <input type="text" class="form-control" value="{{ $item->item_code }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="item_type_id">Jenis Barang</label>
                                <input type="text" class="form-control" value="{{ $itemType->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="unit_type_id">Satuan Barang</label>
                                <input type="text" class="form-control" value="{{ $unitType->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="reorder_level">Stock Barang Minimum</label>
                                <input type="text" class="form-control" value="{{ $item->reorder_level }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock Barang</label>
                                <input type="text" class="form-control" value="{{ $item->stock }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="price">Harga Barang</label>
                                <input type="text" class="form-control"
                                    value="Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }}" disabled>
                            </div>

                            <a href="{{ route('gudang.item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
