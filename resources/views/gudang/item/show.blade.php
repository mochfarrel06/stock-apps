@extends('gudang.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Data Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('gudang.dashboard')],
            ['title' => 'Data barang', 'url' => route('gudang.item.index')],
            ['title' => 'Lihat'],
        ]" />

        <div class="row">

            <div class="col-lg-5 mb-4">
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

            <div class="col-lg-7 mb-4">

                <x-content.table-container>

                    <x-content.table-header :title="'Informasi Data Barang'" :icon="'fas fa-solid fa-eye'" />
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
                                <label>Jenis Barang</label>
                                <input type="text" class="form-control" value="{{ $itemType->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <input type="text" class="form-control" value="{{ $unitType->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Stock Barang Minimum</label>
                                <input type="text" class="form-control" value="{{ $item->reorder_level }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Stock Barang</label>
                                <input type="text" class="form-control" value="{{ $item->stock }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="text" class="form-control"
                                    value="Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }}" disabled>
                            </div>

                            <a href="{{ route('gudang.item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>

                </x-content.table-container>

            </div>
        </div>

    </x-content.container-fluid>
@endsection
