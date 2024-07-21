<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="codeFa">
    <meta name="author" content="codeFa">
    <title>@yield('title-page')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendor/izitoast/css/iziToast.min.css') }}">

    <style>
        .image-upload-wrapper {
            position: relative;
            width: 100%;
            height: 250px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            background-color: #f8f9fa;
        }

        .image-upload-wrapper input[type="file"] {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .image-upload-text {
            font-size: 18px;
            color: #aaa;
            font-weight: bold;
            display: block;
        }

        .preview-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1px solid #ccc;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('administrator.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('administrator.layouts.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            @include('administrator.layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

    <script src="https://kit.fontawesome.com/363895cb1f.js" crossorigin="anonymous"></script>

    <!-- SweetAlert Library for Beautiful Alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/vendor/izitoast/js/iziToast.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $(document).ready(function() {
            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault(); // Prevent default action
                let url = $(this).attr('href'); // Get URL from href attribute
                let row = $(this).closest('tr'); // Get the row to be deleted

                Swal.fire({
                    title: "Apakah anda ingin menghapus data?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request to delete item
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}", // Add CSRF token
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    iziToast.success({
                                        title: 'Success',
                                        message: response.message,
                                        position: 'topRight'
                                    });
                                    row.remove(); // Remove the item from the table

                                    // Update row indices
                                    $('#dataTable tbody tr').each(function(index) {
                                        $(this).find('.index').text(index + 1);
                                    });
                                } else if (response.status === 'error') {
                                    iziToast.error({
                                        title: 'Error',
                                        message: response.message,
                                        position: 'topRight'
                                    });
                                }
                            },
                            error: function(error) {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Terjadi kesalahan saat menghapus data. Silakan coba lagi nanti.',
                                    position: 'topRight'
                                });
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            @if (session('success'))
                iziToast.success({
                    title: 'Berhasil',
                    message: '{{ session('success') }}',
                    position: 'topRight'
                });
            @endif

            @if (session('error'))
                iziToast.error({
                    title: 'Error',
                    message: '{{ session('error') }}',
                    position: 'topRight'
                });
            @endif

            @if (session('info'))
                iziToast.info({
                    title: 'Info',
                    message: '{{ session('info') }}',
                    position: 'topRight'
                });
            @endif
        });
    </script>

    @stack('scripts')
</body>

</html>
