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
    <title>Login Page | Dashboard Sales Performance & Racing Doors SKU</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="login">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="img/paragon-corp.png" alt="Gambar" style="width: 400px; height: auto; margin-right: 60px;">
            </div>
        </div>
        <div class="col-md-6" style="margin-bottom:60px" >
            <div class="card" >
                <div class="card-body">
                <div class="card-body">
                <h2 class="card-title text-center text-primary" style="font-weight: 900;">LOGIN</h2>
                <h6 class="card-title text-center" style="font-weight: 600;">Dashboard Sales Performance & Racing Doors SKU</h6>
                <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 mt-2">
                            <label for="email" class="form-label" style="font-size: 15px;">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" style="font-size: 15px;">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="font-size: 15px;">
                                        {{ __('Remember Me') }}
                                    </label>
                        </div>
                        <div class="mb-3">
                                <button type="submit" class="btn btn-block btn-primary" style="width: 100%; margin-left: 0px">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                <div class="daftar text-center">
                                    <a class="btn btn-link mt-3 " style="text-decoration:none; font-size:15px; " href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </div>

                                @if (Route::has('password.request'))
                                <div class="masuk text-center">
                                    <a class="btn btn-link " style="text-decoration:none; font-size:15px; margin:-20px 0px;" href="{{ route('register') }}"> Don't have an account?
                                        {{ __('Register') }}
                                    </a>
                                @endif
                                </div>
                                
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
</div>
<br>
<br>
<footer class="py-4 text-white mt-4" style="background-color: #2B50A8" margin-top="auto">
        <div class="container text-center">PT Paragon Technology and Innovation | Copyright &copy 
        </div>
    </footer>
</body>
</html>