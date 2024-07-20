@extends('gudang.layouts.master')

@section('title-page')
    Profile
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-lg-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 mt-2 text-gray-900">Profile</h1>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <!-- Gambar Produk -->
                <div class="card shadow">
                    <div class="card-body text-center">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="Location Image" class="img-fluid rounded" />
                        @else
                            <p>Tidak ada gambar yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <!-- Informasi Produk -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Profil</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->username }}" disabled>
                            </div>

                            <a href="{{ route('gudang.profile.editProfile') }}" class="btn btn-success mt-3 mr-2">Edit
                                Profil</a>
                            <a href="{{ route('gudang.profile.editPassword') }}" class="btn btn-warning mt-3">Ganti
                                Password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
