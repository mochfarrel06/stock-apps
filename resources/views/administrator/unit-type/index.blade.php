@extends('administrator.layouts.master')

@section('title-page')
    Satuan Barang
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Halaman Satuan Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Satuan Barang</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary mb-2">Table Satuan Barang</h6>
                <a href="{{ route('admin.unit-type.create') }}"
                    class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-2">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Satuan Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unitTypes as $unitType)
                                <tr>
                                    <td class="index">{{ $loop->index + 1 }}</td>
                                    <td>{{ $unitType->name ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.unit-type.show', $unitType->id) }}"
                                            class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.unit-type.edit', $unitType->id) }}"
                                            class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.unit-type.destroy', $unitType->id) }}"
                                            class="btn btn-danger mr-2 mb-2 delete-item"><i class="fas fa-trash"></i></a>
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