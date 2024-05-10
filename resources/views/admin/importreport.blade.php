@extends('layouts.main-layout')
@section('title','Upload File | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<script>
    // Fungsi untuk menampilkan dialog box
    function showStatusMessage(message, isSuccess) {
        // Membuat elemen div untuk dialog box
        var statusBox = document.createElement('div');
        statusBox.classList.add('status-box');
        
        // Menambahkan kelas success atau error sesuai dengan isSuccess
        isSuccess ? statusBox.classList.add('success') : statusBox.classList.add('error');
        
        // Menambahkan pesan ke dalam elemen div
        statusBox.innerText = message;
        
        // Menambahkan dialog box ke dalam halaman
        document.body.appendChild(statusBox);
        
        // Menghapus dialog box setelah beberapa detik
        setTimeout(function() {
            statusBox.remove();
        }, 3000); // Menghapus setelah 3 detik (3000 milidetik)
    }
</script>
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
      <div class="import-kotak" style="display: flex;justify-content: center;align-items: center;text-align: center;">
      <div class="form-group">
        <img src="img/feather_upload.png" alt="">
        <h1 style="color: #0F91D2; font-weight: 900">Select a file or drag and drop here</h1>
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