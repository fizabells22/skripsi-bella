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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
    $(document).ready(function(){
        // Fungsi untuk melakukan pengurutan data berdasarkan kolom yang di-klik
        $('th[data-sortable]').click(function(){
            var table = $(this).parents('table').eq(0);
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
            this.asc = !this.asc;
            if (!this.asc){
                rows = rows.reverse();
                $(this).find('.sortable-icon i').removeClass('fa-sort-up').addClass('fa-sort-down');
            } else {
                $(this).find('.sortable-icon i').removeClass('fa-sort-down').addClass('fa-sort-up');
            }
            for (var i = 0; i < rows.length; i++){table.append(rows[i])}
        });
        // Fungsi untuk membandingkan nilai
        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index), valB = getCellValue(b, index);
                // Mengubah string menjadi angka jika kolom adalah target_brand atau ach_brand
                if(index === 1 || index === 2){
                    valA = parseFloat(valA.replace(/\./g, '').replace(',', '.'));
                    valB = parseFloat(valB.replace(/\./g, '').replace(',', '.'));
                }
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
            };
        }
        // Fungsi untuk mendapatkan nilai sel
        function getCellValue(row, index){ return $(row).children('td').eq(index).text(); }
    });
</script>
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
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Customer KD
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Customer ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Customer Name
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
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
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Category
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Distribution Center
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
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
                                            <th style="text-align: center; border-bottom: 1px solid #dee2e6; padding: 10px;" data-sortable>Brand ID
                                            <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                            <th style="text-align: center; border-bottom: 1px solid #dee2e6; padding: 10px;"data-sortable>Brand Name
                                            <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
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
                                <div class="card-body custom-card-body">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Product ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Product Name
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Product Status Lifecycle
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Brand ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
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
                                <div class="card-body custom-card-body">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Report ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Bulan Report
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Delivered Nominal Bruto Incppns (Rp)
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Product ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Customer ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Brand ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reports as $reportss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->reports_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $reportss->bulan_report }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($reportss->delivered_nominal_bruto_incppns, 0, ',', '.') }}</td>
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
                                <div class="card-body custom-card-body">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center;border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand (Rp)
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center;border-bottom: 1px solid #dee2e6;"data-sortable>Achievement Brand (Rp)
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>% Brand
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Brand ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesAchievements as $salesAchievementss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesAchievementss->achievement_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesAchievementss->target_brand, 0, ',', '.') }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesAchievementss->ach_brand, 0, ',', '.') }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesAchievementss->persen_brand * 100, 0, ',', '.') }}%</td>  
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
                                <div class="card-body custom-card-body">
                                    <table style="width: 100%; height: 100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Scoreboard ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>% Absensi
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Coverage
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Actual Coverage
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>% Ach/Tar Coverage
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Jumlah RAO
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>% RAO
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Plan Call
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Actual Call
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>% Act/Plan Call
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target E-Call
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Actual E-Call
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>% Act Plan/ E-call
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>
                                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales ID
                                                <span class="sortable-icon">
                                                <i class="fas fa-sort"></i>
                                                </span></th>    

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesScoreboards as $salesScoreboardss)
                                            <tr>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->scoreboard_id }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesScoreboardss->persen_absensis * 100, 0, ',', '.') }}%</td>                                           <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->target_coverages }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->actual_coverages }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesScoreboardss->act_tar_coverages_persen * 100, 0, ',', '.') }}%</td>  
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->jumlahh_rao }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesScoreboardss->persen_raao * 100, 0, ',', '.') }}%</td>  
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->plan_calls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->actual_calls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesScoreboardss->act_plan_calls_persen * 100, 0, ',', '.') }}%</td>  
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->target_ecalls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesScoreboardss->actual_ecalls }}</td>
                                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($salesScoreboardss->act_plan_ecalls_persen * 100, 0, ',', '.') }}%</td>  
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