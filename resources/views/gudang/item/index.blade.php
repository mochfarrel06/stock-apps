@extends('gudang.layouts.master')

@section('title-page')
    Data Barang
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Halaman Data Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item">Data Barang</li>
                </ol>
            </nav>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">Table Data Barang</h6>
                <a href="{{ route('gudang.item.create') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Stok</th>
                                <th>Stok Minimum</th>
                                <th>Harga</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="index">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->stock ?? '' }}</td>
                                    <td>{{ $item->reorder_level ?? '' }}</td>
                                    <td>Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $item->unitType->name }}</td>
                                    <td>
                                        <a href="{{ route('gudang.item.show', $item->id) }}" class="btn btn-warning mr-2"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ route('gudang.item.edit', $item->id) }}"
                                            class="btn btn-success mr-2"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('gudang.item.destroy', $item->id) }}"
                                            class="btn btn-danger mr-2 delete-item"><i class="fas fa-trash"></i></a>
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
