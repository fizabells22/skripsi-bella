<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/project-style.css">
    <link rel="icon" href="img/paragon-corp.png">
    <title>Forgot Password Page | Dashboard Sales Performance & Racing Doors SKU</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="login">
    <div class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" >
                <div class="card-body">
                <div class="card-body">
                <h2 class="card-title text-center text-primary" style="font-weight: 900;">FORGOT PASSWORD</h2>
                <h6 class="card-title text-center" style="font-weight: 600;">Input your email, we will send your reset password link</h6>
                <br>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>
<footer class="py-4 text-white mt-4" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #2B50A8;">
    <div class="container text-center">
        PT Paragon Technology and Innovation | Copyright &copy;
    </div>
</footer>
</body>
</html>