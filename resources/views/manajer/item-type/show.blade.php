@extends('manajer.layouts.master')

@section('title-page')
    Lihat
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Lihat Jenis Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('manajer.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('manajer.item-type.index') }}">Jenis Barang</a></li>
                    <li class="breadcrumb-item">Lihat</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lihat Jenis Barang</h6>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
