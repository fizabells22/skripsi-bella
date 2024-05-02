@extends('layouts.main-layout-user')
@section('title','Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<main>
    <style>
    .custom-card-body {
        max-height: 350px;
        overflow-y: auto;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    // Fungsi untuk melakukan pengurutan data berdasarkan kolom yang di-klik
    $('th[data-sortable]').click(function(){
        var table = $(this).parents('table').eq(0)
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
        this.asc = !this.asc
        if (!this.asc){
            rows = rows.reverse()
            $(this).find('.sortable-icon i').removeClass('fa-sort-up').addClass('fa-sort-down')
        } else {
            $(this).find('.sortable-icon i').removeClass('fa-sort-down').addClass('fa-sort-up')
        }
        for (var i = 0; i < rows.length; i++){table.append(rows[i])}
    })
    // Fungsi untuk membandingkan nilai
    function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
        }
    }
    // Fungsi untuk mendapatkan nilai sel
    function getCellValue(row, index){ return $(row).children('td').eq(index).text() }
})
</script>
                    <h2 class="m-0 font-weight-bold text-primary">Report Sales Achievement</h2>
                    <div class="container-fluid">
                    <!-- Content Row -->
                    <br>
                        </div>
                        <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4 h-100">
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
                            <div class="card shadow mb-4 h-100">
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
    </main>
@endsection