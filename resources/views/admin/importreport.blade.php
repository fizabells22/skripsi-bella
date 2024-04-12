@extends('layouts.main-layout')
@section('title','Upload File | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
      <main>
    <h2 class="m-0 font-weight-bold text-primary">Report Lighthouse</h2>
    <div class="container-fluid">
    <!-- Content Row -->
                    <br>
            <div class="card">
                <div class="card-body">
                <div class="card-body">
                <h2 class="card-title text-center text-primary" ></h2>
                        <div class="mb-3">
                            <form action="{{route ('import')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="fileInput">Choose File</label>
        <input type="file" class="form-control-file" name="csvfile">
      </div>
      <button type="submit" class="btn btn-primary btn-block">
      Upload</button>
    </form>
    </div>
    </div>
</div>
</div>
 @endsection