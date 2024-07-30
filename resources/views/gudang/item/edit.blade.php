@extends('gudang.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Edit Data Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('gudang.dashboard')],
            ['title' => 'Data Barang', 'url' => route('gudang.item.index')],
            ['title' => 'Edit'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Edit Data Barang'" :icon="'fas fa-solid fa-edit'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('gudang.item.update', $item->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="item_code">Kode Barang</label>
                                <input type="text" class="form-control @error('item_code') is-invalid @enderror"
                                    name="item_code" id="item_code" value="{{ old('item_code', $item->item_code) }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name', $item->name) }}">
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
                            </div>

                            <div class="form-group">
                                <label for="reorder_level">Stock Barang Minimum*</label>
                                <input type="number" class="form-control @error('reorder_level') is-invalid @enderror"
                                    name="reorder_level" id="reorder_level"
                                    value="{{ old('reorder_level', $item->reorder_level) }}">
                            </div>

                            <div class="form-group">
                                <label for="price">Harga Barang</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    name="price" id="price" value="{{ old('price', $item->price) }}">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="photo" class="form-label">Gambar Produk</label>
                                <div class="image-upload-wrapper">
                                    <input class="form-control" type="file" id="photo" name="photo"
                                        onchange="previewImage(event)">
                                    <div class="preview-image mt-3">
                                        <img id="preview" src="{{ $item->photo ? asset($item->photo) : '#' }}"
                                            alt="Gambar Produk"
                                            style="{{ $item->photo ? 'display: block;' : 'display: none;' }}">
                                    </div>
                                    <div class="image-upload-text" id="upload-text"
                                        style="{{ $item->photo ? 'display: none;' : 'display: block;' }}">
                                        Choose File
                                    </div>
                                    <div id="error-message" class="text-danger mt-2" style="display: none;"></div>
                                </div>
                                <div class="text-info mt-2">*File harus berformat JPG, JPEG, PNG</div>
                                <div class="text-info">*File harus berukuran 1000 KB</div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-success mt-3">Edit</button>
                    <a href="{{ route('gudang.item.index') }}" class="btn btn-warning mt-3 ml-2">Kembali</a>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
                            sessionStorage.setItem('success', 'Data barang berhasil disubmit.');
                            window.location.href =
                            "{{ route('gudang.item.index') }}"; // Redirect to index page
                        } else if (response.info) {
                            // Flash message info
                            sessionStorage.setItem('info',
                                'Tidak melakukan perubahan pada data barang.');
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

                            if (field === 'photo') {
                                $('#upload-text')
                            .hide(); // Hide "Choose File" text if there is an error
                            }
                        }

                        const message = response.responseJSON.message ||
                            'Terdapat kesalahan pada data barang.';
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
        });

        function previewImage(event) {
            let file = event.target.files[0];
            let reader = new FileReader();
            let output = document.getElementById('preview');
            let uploadText = document.getElementById('upload-text');
            let errorMessage = document.getElementById('error-message');

            reader.onload = function() {
                output.src = reader.result;
                output.style.display = 'block';
                uploadText.style.display = 'none'; // Hide the "Choose File" text
            };

            reader.readAsDataURL(file);
        }
    </script>
@endpush
