@extends('gudang.layouts.master')

@section('title-page')
    Tambah
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Satuan Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('gudang.dashboard')],
            ['title' => 'Satuan barang', 'url' => route('gudang.unit-type.index')],
            ['title' => 'Tambah'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Satuan Barang'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('gudang.unit-type.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Satuan Barang</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name') }}" placeholder="Masukkan Satuan Barang">
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-primary mt-3">Tambah</button>
                    <a href="{{ route('gudang.unit-type.index') }}" class="btn btn-warning mt-3 ml-2">Kembali</a>
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
                                'Satuan barang berhasil disubmit.');
                            window.location.href =
                                "{{ route('gudang.unit-type.index') }}"; // Redirect to index page
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
                            'Terdapat kesalahan pada proses satuan barang';
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
    </script>
@endpush
