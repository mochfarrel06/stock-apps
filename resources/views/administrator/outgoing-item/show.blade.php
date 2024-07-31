@extends('administrator.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Barang Keluar'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Barang Keluar', 'url' => route('admin.outgoing-item.index')],
            ['title' => 'Lihat'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Barang Keluar'" :icon="'fas fa-solid fa-eye'" />

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

                    <a href="{{ route('admin.outgoing-item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                </form>
            </div>
        </x-content.table-container>

    </x-content.container-fluid>
@endsection
