@extends('gudang.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lihat Satuan Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.unit-type.index') }}">Satuan Barang</a></li>
                    <li class="breadcrumb-item">Lihat</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lihat Satuan Barang</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label for="name">Satuan Barang</label>
                                <input type="text" class="form-control" value="{{ old('name', $unitType->name) }}"
                                    disabled>
                            </div>

                            <a href="{{ route('gudang.unit-type.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
