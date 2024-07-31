@extends('manajer.layouts.master')

@section('title-page')
    Laporan Barang Masuk
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Laporan Barang Masuk'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('manajer.dashboard')], ['title' => 'Laporan Barang Masuk']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Filter Barang Masuk'" :icon="'fas fa-solid fa-filter'" />

            <div class="card-body">
                <form action="{{ route('manajer.incoming-report.index') }}" method="GET">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2 mb-2">Tampilkan Data</button>
                        <a href="{{ route('manajer.incoming-report.exportPdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-warning mr-2 mb-2"><i class="fas fa-solid fa-file-pdf"></i> Export
                            PDF</a>
                        <a href="{{ route('manajer.incoming-report.exportExcel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                    </div>
                </form>
            </div>
        </x-content.table-container>

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Barang Masuk'" :icon="'fas fa-solid fa-table'" />

            <x-content.table-body>

                <x-content.thead :items="['No', 'Kode Barang', 'Nama barang', 'Jumlah', 'Tanggal']" />

                <tbody>
                    @foreach ($incomingItems as $incomingItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $incomingItem->item->item_code ?? '' }}</td>
                            <td>{{ $incomingItem->item->name ?? '' }}</td>
                            <td>{{ $incomingItem->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-content.table-body>

        </x-content.table-container>
    </x-content.container-fluid>
@endsection
