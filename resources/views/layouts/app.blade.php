<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/admin.css">
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <img src="img/paragon-corp.png" alt="Gambar" style="max-width: 100%; height: auto;">
            </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
          <!-- Divider -->
          <hr class="sidebar-divider my-0">
<!-- Heading -->
<div class="sidebar-heading">
  Dashboard
</div>
<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" a href="{{ route('dashboardracing') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Racing Doors SKU</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" a href="{{ route('dashboardsales') }}">
      <i class="fa fa-shopping-cart"></i>
      <span>Sales Performance</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
 Report Chart
</div>

 <!-- Nav Item - Dashboard -->
 <li class="nav-item">
  <i class="fa fa-file"></i>
      <span>Lighthouse</span></a>
</li>
<li class="nav-item">
  <i class="fa fa-file"></i>
      <span>Sales Scoreboard</span></a>
</li>
<li class="nav-item">
  <i class="fa fa-file"></i>
      <span>Sales Achievement</span></a>
</li>

          <!-- Divider -->
          <hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
  Others
</div>

 <!-- Nav Item - Dashboard -->
 <li class="nav-item">
  <i class="fa fa-user-circle"></i>
      <span>Account</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
</ul>
<!-- End of Sidebar -->
        @yield('content')
        <script src="{{mix ('js/my-app.js')}}"></script>
    {{-- <script src="/js/jquery-3.6.1.slim.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script> --}}
    <!-- plugin js -->
    <script src="assets/vendor/dropzone/min/dropzone.min.js"></script>
    <!-- init js -->
    <script src="assets/js/ui/component.fileupload.js"></script>
</body>
</html>
