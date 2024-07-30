@extends('gudang.layouts.master')

@section('title-page')
    Laporan Data Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Laporan Data Barang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('gudang.dashboard')], ['title' => 'Laporan Data Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Filter Stok Barang'" :icon="'fas fa-solid fa-filter'" />
            <div class="card-body">
                <form action="{{ route('gudang.item-report.index') }}" method="GET">
                    @csrf

                    <div class="col-lg-6 col-md-12 p-0">
                        <div class="form-group">
                            <label for="filter">Filter Stok Barang</label>
                            <select name="filter" id="filter" class="form-control">
                                <option value="">-- Pilih Stok Barang --</option>
                                <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua Data
                                    Stok</option>
                                <option value="minimum" {{ request('filter') == 'minimum' ? 'selected' : '' }}>Stok
                                    Minimum</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2 mb-2">Tampilkan Data</button>

                        <a href="{{ route('gudang.item-report.exportPdf', ['filter' => request('filter')]) }}"
                            class="btn btn-warning mr-2 mb-2"><i class="fas fa-solid fa-file-pdf"></i> Export
                            Data</a>

                        <a href="{{ route('gudang.item-report.exportExcel', ['filter' => request('filter')]) }}"
                            class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                    </div>
                </form>
            </div>
        </x-content.table-container>

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Data Barang'" :icon="'fas fa-solid fa-table'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Kode Barang', 'Nama barang', 'Stok', 'Stok Minimum', 'Jenis Barang', 'Harga']" />

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $item->item_code ?? '' }}</td>
                            <td>{{ $item->name ?? '' }}</td>
                            <td>{{ $item->stock ?? '' }}</td>
                            <td>{{ $item->reorder_level ?? '' }}</td>
                            <td>{{ $item->itemType->name }}</td>
                            <td>Rp. {{ number_format($item->price ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
