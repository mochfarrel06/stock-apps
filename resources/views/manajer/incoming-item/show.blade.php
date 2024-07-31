@extends('manajer.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Barang Masuk'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('manajer.dashboard')],
            ['title' => 'Barang Masuk', 'url' => route('manajer.incoming-item.index')],
            ['title' => 'Lihat'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Barang Masuk'" :icon="'fas fa-solid fa-eye'" />

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
                        <label>Tanggal Barang Masuk</span></label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}"
                            disabled>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Barang Masuk</span></label>
                        <input type="number" class="form-control" value="{{ $incomingItem->quantity }}" disabled>
                    </div>

                    <a href="{{ route('manajer.incoming-item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                </form>
            </div>
        </x-content.table-container>

    </x-content.container-fluid>
@endsection
