@extends('gudang.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Barang</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">Input Text</label>
                                <input type="text" class="form-control @error('') is-invalid @enderror" name=""
                                    id="" value="" placeholder="">
                                @error('')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
