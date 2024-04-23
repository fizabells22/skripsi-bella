@extends('layouts.main-layout')
@section('title','Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
    <main>
                    <h2 class="m-0 font-weight-bold text-primary">Report Sales Achievement</h2>
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
                        <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                         <!-- Sales Table -->
                         <div class="col-xl-4 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sales Representative</h6>
                                </div>
                                <div class="card-body" style="overflow-y: auto;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Sales Name</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Sales Category</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Distribution Center</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesRepresentatives as $salesRepresentativess)
                                            <tr>
                                                <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesRepresentativess->saless_name }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesRepresentativess->saless_category }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesRepresentativess->distribution_center }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </main>  
@endsection