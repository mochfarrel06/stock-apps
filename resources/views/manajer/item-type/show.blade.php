@extends('manajer.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Jenis Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('manajer.dashboard')],
            ['title' => 'Jenis Barang', 'url' => route('manajer.item-type.index')],
            ['title' => 'Lihat'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Jenis Barang'" :icon="'fas fa-solid fa-eye'" />

            <div class="card-body">
                <form>
                    @csrf

                    <div class="form-group">
                        <label>Jenis Barang</label>
                        <input type="text" class="form-control" value="{{ $itemType->name }}" disabled>
                    </div>
                    <a href="{{ route('manajer.item-type.index') }}" class="btn btn-warning mt-3">Kembali</a>
                </form>
            </div>
        </x-content.table-container>

    </x-content.container-fluid>
@endsection
