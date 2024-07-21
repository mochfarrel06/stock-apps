@extends('administrator.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Edit Pengguna</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 mt-2">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user-management.index') }}">Pengguna</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Pengguna</h6>
                    </div>
                    <div class="card-body">
                        <form id="main-form" action="{{ route('admin.user-management.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control">
                                    <option value="Administrator" {{ $user->role == 'Administrator' ? 'selected' : '' }}>
                                        Administrator</option>
                                    <option value="Gudang" {{ $user->role == 'Gudang' ? 'selected' : '' }}>Gudang</option>
                                    <option value="Manajer" {{ $user->role == 'Manajer' ? 'selected' : '' }}>Manajer
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <button type="submit" id="submit-btn" class="btn btn-success mt-3">Edit</button>
                            <a href="{{ route('admin.user-management.index') }}"
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
                            'Jenis barang berhasil disubmit.');
                        window.location.href =
                            "{{ route('admin.user-management.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada jenis barang.');
                        window.location.href =
                            "{{ route('admin.user-management.index') }}"; // Redirect to index page
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

        function previewImage(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            var output = document.getElementById('preview');
            var uploadText = document.getElementById('upload-text');
            var errorMessage = document.getElementById('error-message');

            // Validasi ukuran file (maks 1MB)
            if (file.size > 1024 * 1024) {
                errorMessage.textContent = '*File harus berukuran maksimal 1000 KB';
                errorMessage.style.display = 'block';
                output.style.display = 'none';
                uploadText.style.display = 'none';
                return;
            }

            // Validasi format file
            var validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validImageTypes.includes(file.type)) {
                errorMessage.textContent = '*File harus berformat JPG, JPEG, PNG';
                errorMessage.style.display = 'block';
                output.style.display = 'none';
                uploadText.style.display = 'none';
                return;
            }

            reader.onload = function() {
                output.src = reader.result;
                output.style.display = 'block';
                uploadText.style.display = 'none'; // Hide the "Choose File" text
                errorMessage.style.display = 'none'; // Hide error message
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush
