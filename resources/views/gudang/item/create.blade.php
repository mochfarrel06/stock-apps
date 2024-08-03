@extends('gudang.layouts.master')

@section('title-page')
    Tambah
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Data Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('gudang.dashboard')],
            ['title' => 'Data Barang', 'url' => route('gudang.item.index')],
            ['title' => 'Tambah'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Data Barang'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('gudang.item.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="item_code">Kode Barang</label>
                                <input type="text" class="form-control @error('item_code') is-invalid @enderror"
                                    name="item_code" id="item_code" value="{{ old('item_code') }}"
                                    placeholder="Masukkan Kode Barang">
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control @error('item_code') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Masukkan Nama Barang">
                            </div>

                            <div class="form-group">
                                <label for="item_type_id">Jenis Barang</label>
                                <select class="form-control @error('item_code') is-invalid @enderror" name="item_type_id"
                                    id="item_type_id">
                                    <option value="">-- Pilih Jenis Barang --</option>
                                    @foreach ($itemTypes as $itemType)
                                        <option value="{{ $itemType->id }}">{{ $itemType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="unit_type_id">Satuan Barang</label>
                                <select class="form-control @error('item_code') is-invalid @enderror" name="unit_type_id"
                                    id="unit_type_id">
                                    <option value="">-- Pilih Satuan Barang --</option>
                                    @foreach ($unitTypes as $unitType)
                                        <option value="{{ $unitType->id }}">{{ $unitType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reorder_level">Stock Barang Minimum*</label>
                                <input type="number" class="form-control @error('item_code') is-invalid @enderror"
                                    name="reorder_level" id="reorder_level" value="{{ old('reorder_level') }}"
                                    placeholder="Masukkan Stock Barang Minimum">
                            </div>

                            <div class="form-group">
                                <label for="price">Harga Barang</label>
                                <input type="number" class="form-control @error('item_code') is-invalid @enderror"
                                    name="price" id="price" value="{{ old('price') }}"
                                    placeholder="Masukkan Harga Barang">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="photo" class="form-label">Gambar Produk</label>
                                <div class="image-upload-wrapper">
                                    <input class="form-control @error('item_code') is-invalid @enderror" type="file"
                                        id="photo" name="photo" onchange="previewImage(event)">
                                    <div class="image-upload-text" id="upload-text">Choose File</div>
                                    <div class="preview-image mt-3">
                                        <img id="preview" src="#" alt="Gambar Produk" style="display: none;">
                                    </div>
                                    <div id="error-message" class="text-danger mt-2" style="display: none;"></div>
                                </div>
                                <div class="text-info mt-2">*File harus berformat JPG, JPEG, PNG</div>
                                <div class="text-info">*File harus berukuran 1000 KB</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('gudang.item.index') }}" class="btn btn-warning ml-2">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const submitBtn = $('#submit-btn');
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const form = $(this)[0];
                const formData = new FormData(form);

                // Validasi ukuran dan format file
                const file = $('#photo')[0].files[0];
                const errorMessage = $('#error-message');
                let valid = true;

                if (file) {
                    if (file.size > 1024 * 1024) {
                        errorMessage.text('*File harus berukuran maksimal 1000 KB');
                        errorMessage.show();
                        valid = false;
                    }

                    const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validImageTypes.includes(file.type)) {
                        errorMessage.text('*File harus berformat JPG, JPEG, PNG');
                        errorMessage.show();
                        valid = false;
                    }
                }

                if (!valid) {
                    return;
                }

                submitBtn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            sessionStorage.setItem('success', 'Data barang berhasil disubmit.');
                            window.location.href = "{{ route('gudang.item.index') }}";
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

                            if (field === 'photo') {
                                $('#upload-text').hide();
                            }
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
                $('#error-message').hide();
            });
        });

        function previewImage(event) {
            let reader = new FileReader();
            let output = document.getElementById('preview');
            let uploadText = document.getElementById('upload-text');

            reader.onload = function() {
                output.src = reader.result;
                output.style.display = 'block';
                uploadText.style.display = 'none'; // Sembunyikan teks "Choose File"
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
