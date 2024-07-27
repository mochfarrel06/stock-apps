@extends('gudang.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Edit Jenis Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('gudang.dashboard')],
            ['title' => 'Jenis Barang', 'url' => route('gudang.item-type.index')],
            ['title' => 'Edit'],
        ]" />

        <x-content.table-container>

            <x-content.table-header :title="'Edit Jenis Barang'" :icon="'fas fa-solid fa-edit'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('gudang.item-type.update', $itemType->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Jenis Barang</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name', $itemType->name) }}">
                        @error('name')
                            <div class="text-danger">*{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" id="submit-btn" class="btn btn-success mt-3">Edit</button>
                    <a href="{{ route('gudang.item-type.index') }}" class="btn btn-warning mt-3 ml-2">Kembali</a>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
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
                            "{{ route('gudang.item-type.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada jenis barang.');
                        window.location.href =
                            "{{ route('gudang.item-type.index') }}"; // Redirect to index page
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
