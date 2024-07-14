@extends('gudang.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lihat Jenis Barang</h1>
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
                                <label for="name">Jenis Barang</label>
                                <input type="text" class="form-control" value="{{ old('name', $itemType->name) }}"
                                    disabled>
                            </div>

                            <a href="{{ route('gudang.item-type.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
