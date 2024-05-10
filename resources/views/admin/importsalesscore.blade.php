@extends('layouts.main-layout')
@section('title','Upload File | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
    <main>
    <h2 class="m-0 font-weight-bold text-primary">Upload Sales Scoreboard</h2>
    <div class="container-fluid">
    <!-- Content Row -->
                    <br>
            <div class="card">
                <div class="card-body">
                <div class="card-body">
                <h2 class="card-title text-center text-primary" ></h2>
                        <div class="mb-3">
                        <form action="{{route ('importsales')}}" method="POST" enctype="multipart/form-data">
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      @csrf
      <div class="import-kotak" style="display: flex;justify-content: center;align-items: center;text-align: center;">
      <div class="form-group">
        <img src="img/feather_upload.png" alt="">
        <h1 style="color: #0F91D2; font-weight: 900">Select a file or drag and drop here</h1>
        <!-- <p style="font-weight: 700">csv file size no more than 10MB</p> -->
        <input type="file" class="form-control-file" name="csvfile" style="margin-left: 30%;">
      </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;">
      Upload</button>
    </form>
    </div>
    </div>
</div>
</div>
 @endsection
 