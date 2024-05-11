<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="img/paragon-corp.png">
    <title>Register Page | Dashboard Sales Performance & Racing Doors SKU</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="css/project-style.css">
</head>
<body>
<div class="register">
        <div class="row">
            <div class="col-md-6 text-center">
            <div class="regis-card">
                <img src="img/paragon-corp.png" alt="Gambar" style="width: 400px; height: auto; margin-right: 60px;">
            </div>
            </div>
        </div>
        <div class="max-height-card col-md-6" style="margin-bottom:60px">
            <div class="card">
                <div class="card-body">
                <div class="card-body">
                <h2 class="card-title text-center text-primary" style="font-weight: 900;">REGISTER</h2>
                <h6 class="card-title text-center" style="font-weight: 600;">Dashboard Sales Performance & Racing Doors SKU</h6>
                <br>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-block btn-primary" style="width: 100%; margin-left: 0px">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                    <div class="text-center">
                                    <a class="btn btn-link" style="text-decoration:none; font-size:15px;" href="{{ route('login') }}"> Already have an account?
                                        {{ __('Login!') }}
                                    </a>
                                @endif
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<footer class="py-4 text-white" style="background-color: #2B50A8">
        <div class="container text-center">PT Paragon Technology and Innovation | Copyright &copy 
        </div>
    </footer>
</body>
</html>
