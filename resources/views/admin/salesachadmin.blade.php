@extends('layouts.main-layout')
@section('title','Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<main>
    <style>
        .custom-card-body {
            max-height: 375px;
            overflow-y: auto;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div class="row">
            <div class="d-sm-flex align-items-center mb-4">
                <a href="{{ route('download.template2') }}" style="margin-right: 20px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Template</a>
                <a href="{{ route('importsalesach') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-upload fa-sm text-white-50"></i> File Upload</a>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement All Brand</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-areaallbrand">
                <canvas id="myAreaChartallbrand"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];
    var persenBrand = [];

    // Assuming dataSales is already defined and structured correctly
    @foreach($dataSales as $sales)
        @if($sales["brand_id"] == 56 || $sales["brand_name"] === "ALL BRAND")
            salesNames.push('{{ $sales["sales_name"] }}');
            targetBrand.push('{{ $sales["target_brand"] }}');
            achBrand.push('{{ $sales["ach_brand"] }}');
            persenBrand.push('{{ $sales["persen_brand"] }}');
        @endif
    @endforeach

    var ctx = document.getElementById('myAreaChartallbrand').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Tipe dasar chart
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Brand',
                data: targetBrand,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Ach Brand',
                data: achBrand,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Persen Brand',
                data: persenBrand,
                type: 'line',
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                yAxisID: 'y-axis-2'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    id: 'y-axis-1',
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        beginAtZero: true
                    }
                },
                {
                    id: 'y-axis-2',
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

 <!-- Master Data Table for ALL BRAND -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data ALL BRAND</h6>
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;"data-sortable>Target ALL BRAND
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;width: 50%;"data-sortable>Pencapaian
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;width: 20%;"data-sortable>Achievement
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $salesDataAllBrand = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "ALL BRAND")
                    @if(!isset($salesDataAllBrand[$data['sales_name']]))
                    @php
                    $salesDataAllBrand[$data['sales_name']] = [
                        'target_all_brand' => 0,
                        'ach_all_brand' => 0,
                        'persen_all_brand' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesDataAllBrand[$data['sales_name']]['target_all_brand'] = $data['target_brand'];
                    $salesDataAllBrand[$data['sales_name']]['ach_all_brand'] = $data['ach_brand'];
                    $salesDataAllBrand[$data['sales_name']]['persen_all_brand'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesDataAllBrand as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_all_brand'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_all_brand'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_all_brand'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

        <!-- ACH WARDAH -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Achievement Wardah</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-arewardah">
                    <canvas id="myAreaChartWardah"></canvas>
                </div>
            </div>
        </div>
    </div>
        <script>
            // Data untuk chart WARDAH (nama sales, target brand, dan ach brand)
            var salesNamesWardah = [];
            var targetBrandWardah = [];
            var achBrandWardah = [];

            // Loop untuk mengisi data WARDAH
            @foreach($dataSales as $sales)
                @if($sales["brand_id"] == 44 || $sales["brand_name"] === "WARDAH")
                    salesNamesWardah.push('{{ $sales["sales_name"] }}');
                    targetBrandWardah.push('{{ $sales["target_brand"] }}');
                    achBrandWardah.push('{{ $sales["ach_brand"] }}');
                @endif
            @endforeach

            // Inisialisasi chart WARDAH
            var ctxWardah = document.getElementById("myAreaChartWardah").getContext('2d');
            var myChartWardah = new Chart(ctxWardah, {
                type: 'bar',
                data: {
                    labels: salesNamesWardah,
                    datasets: [{
                        label: 'Target Brand',
                        data: targetBrandWardah,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Ach Brand',
                        data: achBrandWardah,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>

 <!-- Master Data Table for WARDAH -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Wardah</h6>
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $salesDataWardah = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "WARDAH")
                    @if(!isset($salesDataWardah[$data['sales_name']]))
                    @php
                    $salesDataWardah[$data['sales_name']] = [
                        'target_wardah' => 0,
                        'ach_wardah' => 0,
                        'persen_wardah' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesDataWardah[$data['sales_name']]['target_wardah'] = $data['target_brand'];
                    $salesDataWardah[$data['sales_name']]['ach_wardah'] = $data['ach_brand'];
                    $salesDataWardah[$data['sales_name']]['persen_wardah'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesDataWardah as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_wardah'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_wardah'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_wardah'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH EMINA -->
            <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Achievement Emina</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-areaemina">
                    <canvas id="myAreaChartEmina"></canvas>
                </div>
            </div>
        </div>
    </div>
            <script>
                // Data untuk chart EMINA (nama sales, target brand, dan ach brand)
                var salesNamesEmina = [];
                var targetBrandEmina = [];
                var achBrandEmina = [];

                // Loop untuk mengisi data EMINA
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 45 || $sales["brand_name"] === "EMINA")
                        salesNamesEmina.push('{{ $sales["sales_name"] }}');
                        targetBrandEmina.push('{{ $sales["target_brand"] }}');
                        achBrandEmina.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart EMINA
                var ctxEmina = document.getElementById('myAreaChartEmina').getContext('2d');
                var myChartEmina = new Chart(ctxEmina, {
                    type: 'bar',
                    data: {
                        labels: salesNamesEmina,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandEmina,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandEmina,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Emina</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                        @if($data['brand_name'] === "EMINA")
                            @if(!isset($salesData[$data['sales_name']]))
                                @php
                                    $salesData[$data['sales_name']] = [
                                        'target_emina' => 0,
                                        'ach_emina' => 0,
                                        'persen_emina' => 0,
                                    ];
                                @endphp
                            @endif
                            @php
                                // Update sales data with latest values
                                $salesData[$data['sales_name']]['target_emina'] = $data['target_brand'];
                                $salesData[$data['sales_name']]['ach_emina'] = $data['ach_brand'];
                                $salesData[$data['sales_name']]['persen_emina'] = $data['persen_brand'];
                            @endphp
                        @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                        <tr>
                            <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_emina'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_emina'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_emina'] * 100, 0, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
            <!-- ACH MAKEOVER -->
            <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Achievement MakeOver</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-areamo">
                    <canvas id="myChartMakeover"></canvas>
                </div>
            </div>
        </div>
    </div>
            <script>
                // Data untuk chart MAKEOVER (nama sales, target brand, dan ach brand)
                var salesNamesMakeover = [];
                var targetBrandMakeover = [];
                var achBrandMakeover = [];

                // Loop untuk mengisi data MAKEOVER
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 47 || $sales["brand_name"] === "MAKEOVER")
                        salesNamesMakeover.push('{{ $sales["sales_name"] }}');
                        targetBrandMakeover.push('{{ $sales["target_brand"] }}');
                        achBrandMakeover.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart MAKEOVER
                var ctxMakeover = document.getElementById('myChartMakeover').getContext('2d');
                var myChartMakeover = new Chart(ctxMakeover, {
                    type: 'bar',
                    data: {
                        labels: salesNamesMakeover,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandMakeover,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandMakeover,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data MakeOver</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                        @if($data['brand_name'] === "MAKEOVER")
                            @if(!isset($salesData[$data['sales_name']]))
                                @php
                                    $salesData[$data['sales_name']] = [
                                        'target_makeover' => 0,
                                        'ach_makeover' => 0,
                                        'persen_makeover' => 0,
                                    ];
                                @endphp
                            @endif
                            @php
                                // Update sales data with latest values
                                $salesData[$data['sales_name']]['target_makeover'] = $data['target_brand'];
                                $salesData[$data['sales_name']]['ach_makeover'] = $data['ach_brand'];
                                $salesData[$data['sales_name']]['persen_makeover'] = $data['persen_brand'];
                            @endphp
                        @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                        <tr>
                            <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_makeover'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_makeover'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_makeover'] * 100, 0, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
            <!-- ACH OMG -->
            <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Achievement OMG</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-areaomg">
                    <canvas id="myChartOmg"></canvas>
                </div>
            </div>
        </div>
    </div>

            <script>
                // Data untuk chart OMG (nama sales, target brand, dan ach brand)
                var salesNamesOmg = [];
                var targetBrandOmg = [];
                var achBrandOmg = [];

                // Loop untuk mengisi data OMG
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 46 || $sales["brand_name"] === "OMG")
                        salesNamesOmg.push('{{ $sales["sales_name"] }}');
                        targetBrandOmg.push('{{ $sales["target_brand"] }}');
                        achBrandOmg.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart OMG
                var ctxOmg = document.getElementById('myChartOmg').getContext('2d');
                var myChartOmg = new Chart(ctxOmg, {
                    type: 'bar',
                    data: {
                        labels: salesNamesOmg,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandOmg,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandOmg,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data OMG</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                        @if($data['brand_name'] === "OMG")
                            @if(!isset($salesData[$data['sales_name']]))
                                @php
                                    $salesData[$data['sales_name']] = [
                                        'target_omg' => 0,
                                        'ach_omg' => 0,
                                        'persen_omg' => 0,
                                    ];
                                @endphp
                            @endif
                            @php
                                // Update sales data with latest values
                                $salesData[$data['sales_name']]['target_omg'] = $data['target_brand'];
                                $salesData[$data['sales_name']]['ach_omg'] = $data['ach_brand'];
                                $salesData[$data['sales_name']]['persen_omg'] = $data['persen_brand'];
                            @endphp
                        @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                        <tr>
                            <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_omg'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_omg'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_omg'] * 100, 0, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH PUTRI -->
            <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Achievement Putri</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-areaputri">
                    <canvas id="myChartPutri"></canvas>
                </div>
            </div>
        </div>
    </div>

            <script>
                // Data untuk chart PUTRI (nama sales, target brand, dan ach brand)
                var salesNamesPutri = [];
                var targetBrandPutri = [];
                var achBrandPutri = [];

                // Loop untuk mengisi data PUTRI
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 48 || $sales["brand_name"] === "PUTRI")
                        salesNamesPutri.push('{{ $sales["sales_name"] }}');
                        targetBrandPutri.push('{{ $sales["target_brand"] }}');
                        achBrandPutri.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart PUTRI
                var ctxPutri = document.getElementById('myChartPutri').getContext('2d');
                var myChartPutri = new Chart(ctxPutri, {
                    type: 'bar',
                    data: {
                        labels: salesNamesPutri,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandPutri,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandPutri,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Putri</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                        @if($data['brand_name'] === "PUTRI")
                            @if(!isset($salesData[$data['sales_name']]))
                                @php
                                    $salesData[$data['sales_name']] = [
                                        'target_putri' => 0,
                                        'ach_putri' => 0,
                                        'persen_putri' => 0,
                                    ];
                                @endphp
                            @endif
                            @php
                                // Update sales data with latest values
                                $salesData[$data['sales_name']]['target_putri'] = $data['target_brand'];
                                $salesData[$data['sales_name']]['ach_putri'] = $data['ach_brand'];
                                $salesData[$data['sales_name']]['persen_putri'] = $data['persen_brand'];
                            @endphp
                        @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                        <tr>
                            <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_putri'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_putri'], 0, ',', '.') }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_putri'] * 100, 0, ',', '.') }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH KAHF -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Achievement Kahf</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-areakahf">
                            <canvas id="myChartKahf"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Data untuk chart KAHF (nama sales, target brand, dan ach brand)
                var salesNamesKahf = [];
                var targetBrandKahf = [];
                var achBrandKahf = [];

                // Loop untuk mengisi data KAHF
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 49 || $sales["brand_name"] === "KAHF")
                        salesNamesKahf.push('{{ $sales["sales_name"] }}');
                        targetBrandKahf.push('{{ $sales["target_brand"] }}');
                        achBrandKahf.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart KAHF
                var ctxKahf = document.getElementById('myChartKahf').getContext('2d');
                var myChartKahf = new Chart(ctxKahf, {
                    type: 'bar',
                    data: {
                        labels: salesNamesKahf,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandKahf,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandKahf,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Kahf</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "KAHF")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_kahf' => 0,
                        'ach_kahf' => 0,
                        'persen_kahf' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_kahf'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_kahf'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_kahf'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_kahf'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_kahf'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_kahf'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH INSTAPERFECT -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Achievement Instaperfect</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-areainstaperfect">
                            <canvas id="myChartInstaperfect"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Data untuk chart INSTAPERFECT (nama sales, target brand, dan ach brand)
                var salesNamesInstaperfect = [];
                var targetBrandInstaperfect = [];
                var achBrandInstaperfect = [];

                // Loop untuk mengisi data INSTAPERFECT
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 50 || $sales["brand_name"] === "INSTAPERFECT")
                        salesNamesInstaperfect.push('{{ $sales["sales_name"] }}');
                        targetBrandInstaperfect.push('{{ $sales["target_brand"] }}');
                        achBrandInstaperfect.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart INSTAPERFECT
                var ctxInstaperfect = document.getElementById('myChartInstaperfect').getContext('2d');
                var myChartInstaperfect = new Chart(ctxInstaperfect, {
                    type: 'bar',
                    data: {
                        labels: salesNamesInstaperfect,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandInstaperfect,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandInstaperfect,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Instaperfect</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "INSTAPERFECT")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_instaperfect' => 0,
                        'ach_instaperfect' => 0,
                        'persen_instaperfect' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_instaperfect'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_instaperfect'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_instaperfect'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_instaperfect'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_instaperfect'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_instaperfect'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH CRYSTALLURE -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Achievement Crystallure</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-areacrystallure">
                            <canvas id="myChartCrystallure"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Data untuk chart CRYSTALLURE (nama sales, target brand, dan ach brand)
                var salesNamesCrystallure = [];
                var targetBrandCrystallure = [];
                var achBrandCrystallure = [];

                // Loop untuk mengisi data CRYSTALLURE
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 51 || $sales["brand_name"] === "CRYSTALLURE")
                        salesNamesCrystallure.push('{{ $sales["sales_name"] }}');
                        targetBrandCrystallure.push('{{ $sales["target_brand"] }}');
                        achBrandCrystallure.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart CRYSTALLURE
                var ctxCrystallure = document.getElementById('myChartCrystallure').getContext('2d');
                var myChartCrystallure = new Chart(ctxCrystallure, {
                    type: 'bar',
                    data: {
                        labels: salesNamesCrystallure,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandCrystallure,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandCrystallure,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Crystallure</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "CRYSTALLURE")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_crystallure' => 0,
                        'ach_crystallure' => 0,
                        'persen_crystallure' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_crystallure'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_crystallure'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_crystallure'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_crystallure'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_crystallure'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_crystallure'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

        <!-- ACH BIODEF -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Achievement Biodef</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-areabiodef">
                        <canvas id="myChartBiodef"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Data untuk chart BIODEF (nama sales, target brand, dan ach brand)
            var salesNamesBiodef = [];
            var targetBrandBiodef = [];
            var achBrandBiodef = [];

            // Loop untuk mengisi data BIODEF
            @foreach($dataSales as $sales)
                @if($sales["brand_id"] == 52 || $sales["brand_name"] === "BIODEF")
                    salesNamesBiodef.push('{{ $sales["sales_name"] }}');
                    targetBrandBiodef.push('{{ $sales["target_brand"] }}');
                    achBrandBiodef.push('{{ $sales["ach_brand"] }}');
                @endif
            @endforeach

            // Inisialisasi chart BIODEF
            var ctxBiodef = document.getElementById('myChartBiodef').getContext('2d');
            var myChartBiodef = new Chart(ctxBiodef, {
                type: 'bar',
                data: {
                    labels: salesNamesBiodef,
                    datasets: [{
                        label: 'Target Brand',
                        data: targetBrandBiodef,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Ach Brand',
                        data: achBrandBiodef,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>

        <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Biodef</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "BIODEF")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_biodef' => 0,
                        'ach_biodef' => 0,
                        'persen_biodef' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_biodef'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_biodef'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_biodef'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_biodef'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_biodef'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_biodef'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH WONDERLY -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Achievement Wonderly</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-areawonderly">
                            <canvas id="myChartWonderly"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Data untuk chart WONDERLY (nama sales, target brand, dan ach brand)
                var salesNamesWonderly = [];
                var targetBrandWonderly = [];
                var achBrandWonderly = [];

                // Loop untuk mengisi data WONDERLY
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 53 || $sales["brand_name"] === "WONDERLY")
                        salesNamesWonderly.push('{{ $sales["sales_name"] }}');
                        targetBrandWonderly.push('{{ $sales["target_brand"] }}');
                        achBrandWonderly.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart WONDERLY
                var ctxWonderly = document.getElementById('myChartWonderly').getContext('2d');
                var myChartWonderly = new Chart(ctxWonderly, {
                    type: 'bar',
                    data: {
                        labels: salesNamesWonderly,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandWonderly,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandWonderly,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Wonderly</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "WONDERLY")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_wonderly' => 0,
                        'ach_wonderly' => 0,
                        'persen_wonderly' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_wonderly'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_wonderly'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_wonderly'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_wonderly'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_wonderly'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_wonderly'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

                <!-- ACH LABORE -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Achievement Labore</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-arealabore">
                                <canvas id="myChartLabore"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Data untuk chart LABORE (nama sales, target brand, dan ach brand)
                    var salesNamesLabore = [];
                    var targetBrandLabore = [];
                    var achBrandLabore = [];

                    // Loop untuk mengisi data LABORE
                    @foreach($dataSales as $sales)
                        @if($sales["brand_id"] == 54 || $sales["brand_name"] === "LABORE")
                            salesNamesLabore.push('{{ $sales["sales_name"] }}');
                            targetBrandLabore.push('{{ $sales["target_brand"] }}');
                            achBrandLabore.push('{{ $sales["ach_brand"] }}');
                        @endif
                    @endforeach

                    // Inisialisasi chart LABORE
                    var ctxLabore = document.getElementById('myChartLabore').getContext('2d');
                    var myChartLabore = new Chart(ctxLabore, {
                        type: 'bar',
                        data: {
                            labels: salesNamesLabore,
                            datasets: [{
                                label: 'Target Brand',
                                data: targetBrandLabore,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Ach Brand',
                                data: achBrandLabore,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>

                <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Labore</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "LABORE")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_labore' => 0,
                        'ach_labore' => 0,
                        'persen_labore' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_labore'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_labore'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_labore'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_labore'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_labore'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_labore'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

            <!-- ACH TAVI -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Achievement Tavi</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-areatavi">
                            <canvas id="myChartTavi"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Data untuk chart TAVI (nama sales, target brand, dan ach brand)
                var salesNamesTavi = [];
                var targetBrandTavi = [];
                var achBrandTavi = [];

                // Loop untuk mengisi data TAVI
                @foreach($dataSales as $sales)
                    @if($sales["brand_id"] == 55 || $sales["brand_name"] === "TAVI")
                        salesNamesTavi.push('{{ $sales["sales_name"] }}');
                        targetBrandTavi.push('{{ $sales["target_brand"] }}');
                        achBrandTavi.push('{{ $sales["ach_brand"] }}');
                    @endif
                @endforeach

                // Inisialisasi chart TAVI
                var ctxTavi = document.getElementById('myChartTavi').getContext('2d');
                var myChartTavi = new Chart(ctxTavi, {
                    type: 'bar',
                    data: {
                        labels: salesNamesTavi,
                        datasets: [{
                            label: 'Target Brand',
                            data: targetBrandTavi,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ach Brand',
                            data: achBrandTavi,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

            <!-- Master Data Table -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data Tavi</h6>
                </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Target Brand
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Pencapaian
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Achievement
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                    $salesData = [];
                    @endphp
                    @foreach($dataSales as $data)
                    @if($data['brand_name'] === "TAVI")
                    @if(!isset($salesData[$data['sales_name']]))
                    @php
                    $salesData[$data['sales_name']] = [
                        'target_tavi' => 0,
                        'ach_tavi' => 0,
                        'persen_tavi' => 0,
                    ];
                    @endphp
                    @endif
                    @php
                    // Update sales data with latest values
                    $salesData[$data['sales_name']]['target_tavi'] = $data['target_brand'];
                    $salesData[$data['sales_name']]['ach_tavi'] = $data['ach_brand'];
                    $salesData[$data['sales_name']]['persen_tavi'] = $data['persen_brand'];
                    @endphp
                    @endif
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['target_tavi'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['ach_tavi'], 0, ',', '.') }}</td>
                        <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ number_format($sales['persen_tavi'] * 100, 0, ',', '.') }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    </main>
@endsection
