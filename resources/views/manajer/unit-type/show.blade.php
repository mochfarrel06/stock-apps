@extends('manajer.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Satuan Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('manajer.dashboard')],
            ['title' => 'Satuan Barang', 'url' => route('manajer.unit-type.index')],
            ['title' => 'Lihat'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Satuan Barang'" :icon="'fas fa-solid fa-eye'" />

            <div class="card-body">
                <form>
                    @csrf

                    <div class="form-group">
                        <label>Satuan Barang</label>
                        <input type="text" class="form-control" value="{{ $unitType->name }}" disabled>
                    </div>

                    <a href="{{ route('manajer.unit-type.index') }}" class="btn btn-warning mt-3">Kembali</a>
                </form>
            </div>
        </x-content.table-container>

    </x-content.container-fluid>
@endsection
