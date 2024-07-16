@extends('gudang.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Barang Masuk</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.item.index') }}">Barang</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.incoming-item.index') }}">Barang Masuk</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <form id="main-form" action="{{ route('gudang.incoming-item.update', $incomingItem->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="item_id">Data Barang <span class="text-danger">(Kode Barang - Nama
                                        Barang)</span></label>
                                <select class="form-control @error('item_id') is-invalid @enderror" name="item_id"
                                    id="item_id">
                                    <option value="{{ $incomingItem->item_id }}">{{ $incomingItem->item->item_code }} -
                                        {{ $incomingItem->item->name }}
                                    </option>
                                </select>
                                @error('item_id')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="quantity">Jumlah Barang Masuk</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="{{ old('quantity', $incomingItem->quantity) }}">
                                @error('quantity')
                                    <div class="text-danger">*{{ message }}</div>
                                @enderror
                            </div>

                            <button type="submit" id="submit-btn" class="btn btn-success mt-3">Edit</button>
                            <a href="{{ route('gudang.incoming-item.index') }}"
                                class="btn btn-warning mt-3 ml-2">Kembali</a>
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
                            'Barang masuk berhasil disubmit.');
                        window.location.href =
                            "{{ route('gudang.incoming-item.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada barang masuk.');
                        window.location.href =
                            "{{ route('gudang.incoming-item.index') }}"; // Redirect to index page
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
                        'Terdapat kesalahan pada barang masuk.';
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
