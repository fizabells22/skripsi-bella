@extends('layouts.main-layout')
@section('title','Dashboard Racing Doors SKU')

@section('content')
<style>
        html,
        body,
        .container-fluid {
            height: 100%;
        }

        .card {
            height: 100%;
        }

        .aspect-ratio-16x9 {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }

        .aspect-ratio-16x9 iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
    </style>
 <main>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Dashboard Racing Doors SKU</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <div class="aspect-ratio-16x9">
                            <div class="embed-responsive-item">
                        <iframe src="https://lookerstudio.google.com/embed/reporting/57350881-ebb4-43c0-9928-31c1e293e511/page/p_yfa5hfsf1c" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
                            </div>
                        </div>
                        </div>
                    </div>
    <!-- Page Heading -->            
                </main>  
@endsectionssss