<!-- Container Section Login -->
<div class="container">
    <!-- Section Row -->
    <div class="row justify-content-center">
        <!-- Section Column -->
        <div class="col-xl-6 col-lg-8 col-md-8">
            <!-- Card -->
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="100"
                                        class="shadow-light rounded-circle">
                                </div>
                                <div class="text-center">
                                    <h4 class="text-gray-900 mb-4 ">{{ $title }}</h4>
                                </div>
                                <form class="user mt-5" method="POST" action="{{ route($route) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text"
                                            class="form-control form-control-user @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username') }}"
                                            placeholder="Masukkan Username Anda" autofocus>
                                        @error('username')
                                            <div class="text-danger" style="font-size: 0.8em">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Password</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" id="exampleInputPassword"
                                                placeholder="Masukkan Password" autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="text-danger" style="font-size: 0.8em">*{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>

                                <div class="text-center mt-5">
                                    <p class="small text-dark">© 2024 CodeFa. All
                                        rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Section Column -->
    </div>
    <!-- End Section Row -->
</div>
<!-- End Container Section Login -->
