@extends('layouts.main-layout-user')
@section('title','Master Data | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
    <main>
    <style>
    .custom-card-body {
        max-height: 300px;
        overflow-y: auto;
    }
    </style>
                    <h2 class="m-0 font-weight-bold text-primary">Master Data</h2>
                    <div class="container-fluid">
                    <!-- Content Row -->
                        <br>
                        </div>
                        <div class="row">

                        <!-- Customers Table -->
                        <div class="col-xl col-lg-6">
                            <div class="card shadow mb-4 custom-card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
                                </div>
                                <div class="card-body custom-card-body">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Customer KD</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Customer ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Customer Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customers as $customerss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $customerss->customers_kd }}</td>
                                                <td style=" text-align: center;border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $customerss->customers_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $customerss->customers_name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Sales Table -->
                        <div class="col-xl col-lg-6">
                            <div class="card shadow mb-4 custom-card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sales Representative</h6>
                                </div>
                                <div class="card-body custom-card-body">
                                    <table style="width: 100%; height: 100%">
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

                        <!-- Brand Table -->
                        <div class="col-xl col-lg-6">
                        <div class="card shadow mb-4 custom-card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Brand</h6>
                            </div>
                            <div class="card-body custom-card-body">
                                <table style="width: 100%; height: 100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; border-bottom: 1px solid #dee2e6; padding: 10px;">Brand ID</th>
                                            <th style="text-align: center; border-bottom: 1px solid #dee2e6; padding: 10px;">Brand Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brands as $brandss)
                                        <tr>
                                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px; padding: 10px;">{{ $brandss->brand_id }}</td>
                                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px; padding: 10px;">{{ $brandss->brand_name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                        <!-- Product Table -->
                        <div class="col-12 mt-2">
                            <div class="card shadow mb-4 h-100">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Product</h6>
                                </div>
                                <div class="card-body" style="overflow-y: auto;">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Product ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Product Name</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Product Status Lifecycle</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Brand ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $productss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $productss->product_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $productss->product_name }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $productss->product_status_lifecycles }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $productss->brand_id }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Reeport Table -->
                        <div class="col-12 mt-4">
                            <div class="card shadow mb-4 h-100">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Report Lighthouse</h6>
                                </div>
                                <div class="card-body" style="overflow-y: auto;">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Report ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Bulan Report</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Delivered Nominal Bruto Incppns</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Product ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Sales ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Customer ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Brand ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reports as $reportss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->reports_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->bulan_report }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->delivered_nominal_bruto_incppns }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->product_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->sales_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->customers_kd }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->brand_id }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Sales Achievement Table -->
                        <div class="col-12 mt-4">
                            <div class="card shadow mb-4 h-100">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sales Achievement</h6>
                                </div>
                                <div class="card-body" style="overflow-y: auto;">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Achievement ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Target Brand</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Achievement Brand</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">% Brand</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Sales ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Brand ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesAchievements as $salesAchievementss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->achievement_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->target_brand }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->ach_brand }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->persen_brand }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->sales_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->brand_id }}</td>
                                           </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                         <!-- Sales Scoreboard Table -->
                         <div class="col-12 my-4">
                            <div class="card shadow mb-4 h-100">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sales Scoreboard</h6>
                                </div>
                                <div class="card-body" style="overflow-y: auto;">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Scoreboard ID</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">% Absensi</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Target Coverage</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Actual Coverage</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">% Ach/Tar Coverage</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Jumlah RAO</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">% RAO</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Plan Call</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Actual Call</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">% Act/Plan Call</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Target E-Call</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Actual E-Call</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">% Act Plan/ E-call</th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;">Sales ID</th>    

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesScoreboards as $salesScoreboardss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->scoreboard_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->persen_absensis }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->target_coverages }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->actual_coverages }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->act_tar_coverages_persen }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->jumlahh_rao }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->persen_raao }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->plan_calls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->actual_calls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->act_plan_calls_persen }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->target_ecalls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->actual_ecalls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->act_plan_ecalls_persen }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->sales_id }}</td>
                                           </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       
    </main>
@endsection