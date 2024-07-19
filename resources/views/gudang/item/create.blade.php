@extends('gudang.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Tambah Data Barang</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Data Barang</a></li>
                    <li class="breadcrumb-item">Tambah</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <form id="main-form" action="{{ route('gudang.item.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="item_code">Kode Barang</label>
                                        <input type="text" class="form-control @error('item_code') is-invalid @enderror"
                                            name="item_code" id="item_code" value="{{ old('item_code') }}"
                                            placeholder="Masukkan Kode Barang">
                                        @error('item_code')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Nama Barang</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ old('name') }}"
                                            placeholder="Masukkan Nama Barang">
                                        @error('name')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="item_type_id">Jenis Barang</label>
                                        <select class="form-control @error('item_type_id') is-invalid @enderror"
                                            name="item_type_id" id="item_type_id">
                                            <option value="">-- Pilih Jenis Barang --</option>
                                            @foreach ($itemTypes as $itemType)
                                                <option value="{{ $itemType->id }}">{{ $itemType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('item_type_id')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_type_id">Satuan Barang</label>
                                        <select class="form-control @error('unit_type_id') is-invalid @enderror"
                                            name="unit_type_id" id="unit_type_id">
                                            <option value="">-- Pilih Satuan Barang --</option>
                                            @foreach ($unitTypes as $unitType)
                                                <option value="{{ $unitType->id }}">{{ $unitType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_type_id')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="reorder_level">Stock Barang Minimum*</label>
                                        <input type="number"
                                            class="form-control @error('reorder_level') is-invalid @enderror"
                                            name="reorder_level" id="reorder_level" value="{{ old('reorder_level') }}"
                                            placeholder="Masukkan Stock Barang Minimum">
                                        @error('reorder_level')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga Barang</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            name="price" id="price" value="{{ old('price') }}"
                                            placeholder="Masukkan Harga Barang">
                                        @error('price')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="photo" class="form-label">Gambar Produk</label>
                                        <div class="image-upload-wrapper">
                                            <input class="form-control" type="file" id="photo" name="photo"
                                                onchange="previewImage(event)">
                                            <div class="image-upload-text" id="upload-text">
                                                Choose File
                                            </div>
                                            <div class="preview-image mt-3">
                                                <img id="preview" src="#" alt="Gambar Produk"
                                                    style="display: none;">
                                            </div>
                                        </div>
                                        <div class="text-info mt-2">*File harus berformat JPG, JPEG, PNG</div>
                                        <div class="text-info">*File harus berukuran 1000 KB</div>
                                        @error('photo')
                                            <div class="text-danger">*{{ message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submit-btn" class="btn btn-primary mt-3">Tambah</button>
                            <a href="{{ route('gudang.item.index') }}" class="btn btn-warning mt-3 ml-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const submitBtn = $('#submit-btn');
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const form = $(this)[0];
                const formData = new FormData(form); // Create FormData object with form data

                submitBtn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the content type
                    success: function(response) {
                        if (response.success) {
                            sessionStorage.setItem('success',
                                'Data barang berhasil disubmit.');
                            window.location.href =
                                "{{ route('gudang.item.index') }}"; // Redirect to index page
                        } else {
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
                            input.next('.invalid-feedback').remove();
                            input.after('<div class="invalid-feedback">' + error + '</div>');
                        }

                        const message = response.responseJSON.message ||
                            'Terdapat kesalahan pada proses data barang';
                        $('#flash-messages').html('<div class="alert alert-danger">' + message +
                            '</div>');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text('Tambah');
                    }
                });
            });

            $('input, select, textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').text('');
            });
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                var uploadText = document.getElementById('upload-text');
                output.src = reader.result;
                output.style.display = 'block';
                uploadText.style.display = 'none'; // Hide the "Choose File" text
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
