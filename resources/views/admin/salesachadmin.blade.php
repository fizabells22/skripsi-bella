@extends('layouts.main-layout')
@section('title','Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
    <main>
                    <div class="container-fluid px-4">
                        <h1 class="h3 mb-0 mt-3 ml-4" style="color: #5A6ACF">Report Sales Achievement</h1>
                        <div class="container-fluid">
                    <!-- Content Row -->
                    <br>
                    <div class="row">
                    <div class="d-sm-flex align-items-center mb-4" >
                        <a href="{{ route('download.template2') }}" style="margin-right: 20px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Download Template</a>
                        <a href="{{ route('importsalesach') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-upload fa-sm text-white-50"></i> File Upload</a>
                    </div>
            </div>
                        </div>
                        <div class="container">
    </div>

                    </div>
                </main>  
</script>
@endsection