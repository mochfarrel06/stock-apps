@extends('manajer.layouts.master')

@section('title-page')
    Edit Profile
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Profile</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                    </div>
                    <div class="card-body">
                        <form id="main-form" action="{{ route('manajer.profile.updateProfile') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="avatar" class="form-label">Gambar Produk</label>
                                        <div class="image-upload-wrapper">
                                            <input class="form-control" type="file" id="avatar" name="avatar"
                                                onchange="previewImage(event)">

                                            <!-- Tampilkan gambar yang sudah ada -->
                                            <div class="preview-image mt-3">
                                                <img id="preview"
                                                    src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : '#' }}"
                                                    alt="Gambar Produk"
                                                    style="{{ auth()->user()->avatar ? 'display: block;' : 'display: none;' }}">
                                            </div>

                                            <div class="image-upload-text" id="upload-text"
                                                style="{{ auth()->user()->avatar ? 'display: none;' : 'display: block;' }}">
                                                Choose File
                                            </div>
                                        </div>
                                        <div class="text-info mt-2">*File harus berformat JPG, JPEG, PNG</div>
                                        <div class="text-info">*File harus berukuran 1000 KB</div>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ auth()->user()->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" id="username" name="username" class="form-control"
                                            value="{{ auth()->user()->username }}">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <button type="submit" id="submit-btn" class="btn btn-success">Edit</button>
                                <a href="{{ route('manajer.profile.index') }}" class="btn btn-warning ml-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
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
                            'profil berhasil disubmit.');
                        window.location.href =
                            "{{ route('manajer.profile.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada profil.');
                        window.location.href =
                            "{{ route('manajer.profile.index') }}"; // Redirect to index page
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
                        'Terdapat kesalahan pada profile.';
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
