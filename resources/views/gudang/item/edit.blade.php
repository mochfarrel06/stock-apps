@extends('gudang.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Data Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Data Barang</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <!-- Gambar Produk -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        @if ($item->photo)
                            <img src="{{ asset($item->photo) }}" alt="Location Image" class="img-fluid rounded" />
                        @else
                            <p>Tidak ada gambar yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <!-- Informasi Produk -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lihat Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <form id="main-form" action="{{ route('gudang.item.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="item_code">Kode Barang</label>
                                <input type="text" class="form-control @error('item_code') is-invalid @enderror"
                                    name="item_code" id="item_code" value="{{ old('item_code', $item->item_code) }}">
                                @error('item_code')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', $item->name) }}">
                                @error('name')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="item_type_id">Jenis Barang</label>
                                <select class="form-control @error('item_type_id') is-invalid @enderror" name="item_type_id"
                                    id="item_type_id">
                                    <option value="">-- Pilih Jenis Barang --</option>
                                    @foreach ($itemTypes as $itemType)
                                        <option value="{{ $itemType->id }}"
                                            {{ $itemType->id === $item->item_type_id ? 'selected' : '' }}>
                                            {{ $itemType->name }}</option>
                                    @endforeach
                                </select>
                                @error('item_type_id')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="unit_type_id">Satuan Barang</label>
                                <select class="form-control @error('unit_type_id') is-invalid @enderror" name="unit_type_id"
                                    id="unit_type_id">
                                    <option value="">-- Pilih Satuan Barang --</option>
                                    @foreach ($unitTypes as $unitType)
                                        <option value="{{ $unitType->id }}"
                                            {{ $unitType->id === $item->unit_type_id ? 'selected' : '' }}>
                                            {{ $unitType->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_type_id')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="reorder_level">Stock Barang Minimum*</label>
                                <input type="number" class="form-control @error('reorder_level') is-invalid @enderror"
                                    name="reorder_level" id="reorder_level"
                                    value="{{ old('reorder_level', $item->reorder_level) }}">
                                @error('reorder_level')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Harga Barang</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" id="price" value="{{ old('price', $item->price) }}">
                                @error('price')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo" class="form-label">Gambar Produk</label>
                                <input class="form-control" type="file" id="photo" name="photo"
                                    value="{{ old('photo', $item->photo) }}">
                                @error('photo')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <button type="submit" id="submit-btn" class="btn btn-success mt-3">Edit</button>
                            <a href="{{ route('gudang.item.index') }}" class="btn btn-warning mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Handle form submission using AJAX
        $('#main-form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const form = $(this);
            const formData = new FormData(form[0]); // Use FormData to handle file uploads
            const submitButton = $('#submit-btn');
            submitButton.prop('disabled', true).text('Loading...');

            $.ajax({
                url: form.attr('action'),
                method: 'POST', // Use POST for form submission
                data: formData,
                contentType: false, // Prevent jQuery from setting content type
                processData: false, // Prevent jQuery from processing data
                success: function(response) {
                    if (response.success) {
                        // Flash message sukses
                        sessionStorage.setItem('success',
                            'Jenis barang berhasil disubmit.');
                        window.location.href =
                            "{{ route('gudang.item.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada jenis barang.');
                        window.location.href =
                            "{{ route('gudang.item.index') }}"; // Redirect to index page
                    } else {
                        // Flash message error
                        $('#flash-messages').html('<div class="alert alert-danger">' +
                            response.error + '</div>');
                    }
                },
                error: function(response) {
                    const errors = response.responseJSON.errors;
                    for (let field in errors) {
                        let input = $('[name=' + field + ']');
                        let error = errors[field][0];
                        input.addClass('is-invalid');
                        // Remove existing invalid feedback to avoid duplicates
                        input.next('.invalid-feedback').remove();
                        input.after('<div class="invalid-feedback">' + error + '</div>');
                    }

                    const message = response.responseJSON.message ||
                        'Terdapat kesalahan pada jenis barang.';
                    $('#flash-messages').html('<div class="alert alert-danger">' + message +
                        '</div>');
                },
                complete: function() {
                    submitButton.prop('disabled', false).text('Edit');
                }
            });
        });

        // Remove validation error on input change
        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        });
    </script>
@endpush
