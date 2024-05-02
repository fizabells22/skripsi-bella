<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="img/paragon-corp.png">
    <title>Reset Password Page | Dashboard Sales Performance & Racing Doors SKU</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href=<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/project-style.css">
</head>
<body>
<div class="login">
    <div class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" >
                <div class="card-body">
                <div class="card-body">
                <h2 class="card-title text-center text-primary" style="font-weight: 900;">RESET PASSWORD</h2>
                <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <div class="form-group">
                    <label class="font-weight-bold">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $request->email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Alamat Email">
                    @error('email')
                    <div class="alert alert-danger mt-2">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    </div>
                </div>

                <div class="mb-3">
                <div class="form-group">
                    <label class="font-weight-bold">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Masukkan Password Baru">
                    @error('password')
                    <div class="alert alert-danger mt-2">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                </div>

                <div class="mb-3">
                <div class="form-group">
                    <label class="font-weight-bold">Konfirmasi Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Masukkan Konfirmasi Password Baru">
                </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary" style="width: 100%;">
                                        {{ __('Login') }}
                                    </button>
            </div>
        </form>
    </div>
</div>
<footer class="py-4 text-white mt-4" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #2B50A8;">
    <div class="container text-center">
        PT Paragon Technology and Innovation | Copyright &copy;
    </div>
</footer>
</body>
</html>