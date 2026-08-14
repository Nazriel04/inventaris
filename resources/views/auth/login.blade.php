<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>

    <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
            <div class="p-4 m-3">
                <div class="text-center mb-5 mt-4">

                    <img src="{{ asset('assets/img/unsplash/logo-sman.png') }}" alt="Logo SMAN 1 Tanjungsiang"
                        width="120" class="mb-3">

                    <h4 class="font-weight-bold text-dark mb-1">
                        Sistem Manajemen Aset
                    </h4>

                    <p class="text-muted">
                        SMAN 1 Tanjungsiang
                    </p>

                </div>
                @include('utilities.alert')
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" tabindex="1" placeholder="Masukan alamat email.."
                            value="{{ old('email') }}" required autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') @enderror"
                            name="password" tabindex="2" placeholder="Masukan kata sandi.." required>
                        <div class="invalid-feedback">
                            Mohon masukkan password!
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
                <center><br>
                    <p></a></p>
                </center>
            </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 position-relative overlay-gradient-bottom"
            data-background="../assets/img/unsplash/login-bg.jpg">

            <div class="absolute-bottom-left index-2">
                <div class="text-light p-5 pb-2">
                    <div class="mb-5 pb-3">

                        <h1 class="display-3 font-weight-bold text-white mb-4" id="greetings"
                            style="text-shadow: 4px 4px 15px rgba(0,0,0,0.9);">
                        </h1>

                    </div>
                </div>
            </div>
            </section>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

        <!-- Page Specific JS File -->
        @include('layouts.partials.greetings')

        <script>
            $(document).ready(function() {
                $("#greetings").html(greetings());
            });
        </script>
</body>

</html>
