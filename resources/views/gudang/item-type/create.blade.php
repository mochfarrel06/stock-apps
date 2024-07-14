@extends('gudang.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Jenis Barang</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Jenis Barang</h6>
                    </div>
                    <div class="card-body">
                        <form id="main-form" action="{{ route('gudang.item-type.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Jenis Barang</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Masukkan Jenis Barang">
                                @error('name')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" id="submit-btn" class="btn btn-primary mt-3">Tambah</button>
                            <a href="{{ route('gudang.item-type.index') }}" class="btn btn-warning mt-3 ml-2">Kembali</a>
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
            const $submitBtn = $('#submit-btn');
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const form = $(this)[0];
                const formData = new FormData(form); // Create FormData object with form data

                $submitBtn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the content type
                    success: function(response) {
                        if (response.success) {
                            sessionStorage.setItem('success',
                                'Jenis barang berhasil disubmit.');
                            window.location.href =
                                "{{ route('gudang.item-type.index') }}"; // Redirect to index page
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
                            'Terdapat kesalahan pada proses jenis barang';
                        $('#flash-messages').html('<div class="alert alert-danger">' + message +
                            '</div>');
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).text('Tambah');
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
