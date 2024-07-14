@extends('gudang.layouts.master')

@section('title-page')
    Jenis Barang
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Halaman Jenis Barang</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">Table Jenis Barang</h6>
                <a href="{{ route('gudang.item-type.create') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemTypes as $itemType)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $itemType->name }}</td>
                                    <td>
                                        <a href="{{ route('gudang.item-type.show', $itemType->id) }}"
                                            class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
