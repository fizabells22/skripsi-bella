@extends('layouts.main-layout')
@section('title', 'Welcome! | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Selamat Datang!</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('admin.adminHome') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard Sales Performance & Racing Doors SKU</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Website ini dapat digunakan sebagai alat bantu monitoring persebaran active New Product Development (NPD) dan kinerja sales representative di area sales Kediri.
                                </p>
                            </div>
                        </div>
@endsection
