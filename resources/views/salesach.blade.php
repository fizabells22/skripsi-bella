@extends('layouts.main-layout-user')
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
    </div>
    <br>
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
    // Initialize arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];
    var persenBrand = [];

    // Object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Process only 'ALL BRAND'
        if (brandName === 'ALL BRAND') {
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update data
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}', 10);
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}', 10);
                    persenBrand[index] = parseFloat('{{ $sales["persen_brand"] }}'); // Assuming this is a float
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}', 10));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}', 10));
                    persenBrand.push(parseFloat('{{ $sales["persen_brand"] }}')); // Assuming this is a float
                }
            }
        }
    @endforeach

    var ctx = document.getElementById('myAreaChartallbrand').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target All Brand',
                data: targetBrand,
                backgroundColor: '#F5DD61',
                borderColor: '#F5DD61',
                borderWidth: 1
            }, {
                label: 'Ach All Brand',
                data: achBrand,
                backgroundColor: '#68D2E8',
                borderColor: '#68D2E8',
                borderWidth: 1
            }, {
                label: '% Achievement',
                data: persenBrand,
                type: 'line',
                fill: false,
                backgroundColor: '#FAA300',
                borderColor: '#FAA300',
                borderWidth: 2,
                yAxisID: 'y2'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                y2: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false
                    }
                }
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
                <div class="chart-areawardah">
                    <canvas id="myAreaChartWardah"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'WARDAH') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myAreaChartWardah').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Wardah',
                data: targetBrand,
                backgroundColor: '#68D2E8',
                borderColor: '#CAF4FF',
                borderWidth: 1
            },
            {
                label: 'Achievement Wardah',
                data: achBrand,
                backgroundColor: '#03AED2',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'EMINA') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myAreaChartEmina').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Emina',
                data: targetBrand,
                backgroundColor: '#FF9E9E',
                borderColor: '#FFCAC8',
                borderWidth: 1
            },
            {
                label: 'Achievement Emina',
                data: achBrand,
                backgroundColor: '#FF6464',
                borderColor: '#FF7D7D',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'MAKEOVER') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartMakeover').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target MakeOver',
                data: targetBrand,
                backgroundColor: '#FFCACA',
                borderColor: '#FFCACA',
                borderWidth: 1
            },
            {
                label: 'Achievement MakeOver',
                data: achBrand,
                backgroundColor: '#F10086',
                borderColor: '#F10086',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'OMG') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartOmg').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target OMG',
                data: targetBrand,
                backgroundColor: '#F1AE89',
                borderColor: '#C75643',
                borderWidth: 1
            },
            {
                label: 'Achievement OMG',
                data: achBrand,
                backgroundColor: '#C51605',
                borderColor: '#DF2E38',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'PUTRI') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartPutri').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Putri',
                data: targetBrand,
                backgroundColor: '#FF7A00',
                borderColor: '#FFEFCF',
                borderWidth: 1
            },
            {
                label: 'Achievement Putri',
                data: achBrand,
                backgroundColor: '#D44000',
                borderColor: '#FFEFCF',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'KAHF') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartKahf').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Kahf',
                data: targetBrand,
                backgroundColor: '#A2A378',
                borderColor: '#A2A378',
                borderWidth: 1
            },
            {
                label: 'Achievement Kahf',
                data: achBrand,
                backgroundColor: '#294B29',
                borderColor: '#294B29',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'INSTAPERFECT') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartInstaperfect').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Instaperfect',
                data: targetBrand,
                backgroundColor: '#FFE5CA',
                borderColor: '#FFE5CA',
                borderWidth: 1
            },
            {
                label: 'Achievement Instaperfect',
                data: achBrand,
                backgroundColor: '#A64B2A',
                borderColor: '#A64B2A',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'CRYSTALLURE') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartCrystallure').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Crystallure',
                data: targetBrand,
                backgroundColor: '#E5BA73',
                borderColor: '#E5BA73',
                borderWidth: 1
            },
            {
                label: 'Achievement Crystallure',
                data: achBrand,
                backgroundColor: '#C58940',
                borderColor: '#C58940',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'BIODEF') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartBiodef').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Biodef',
                data: targetBrand,
                backgroundColor: '#C4DFDF',
                borderColor: '#C4DFDF',
                borderWidth: 1
            },
            {
                label: 'Achievement Biodef',
                data: achBrand,
                backgroundColor: '#2F538C',
                borderColor: '#2F538C',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'WONDERLY') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartWonderly').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Wonderly',
                data: targetBrand,
                backgroundColor: '#E1AFD1',
                borderColor: '#E1AFD1',
                borderWidth: 1
            },
            {
                label: 'Achievement Wonderly',
                data: achBrand,
                backgroundColor: '#AD88C6',
                borderColor: '#AD88C6',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'LABORE') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartLabore').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Labore',
                data: targetBrand,
                backgroundColor: '#FFCAD4',
                borderColor: '#FFCAD4',
                borderWidth: 1
            },
            {
                label: 'Achievement Labore',
                data: achBrand,
                backgroundColor: '#FF407D',
                borderColor: '#FF407D',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
    // Initialize empty arrays to store data
    var salesNames = [];
    var targetBrand = [];
    var achBrand = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataSales as $sales)
        var salesName = '{{ $sales["sales_name"] }}';
        var updatedAt = '{{ $sales["updated_at"] }}';
        var brandName = '{{ $sales["brand_name"] }}';

        // Filter only WARDAH brand
        if (brandName === 'TAVI') {
            // Check if the sales name is already in the array and if the current data has a newer updated_at
            if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
                // Update the latest updated_at for the sales name
                latestUpdate[salesName] = updatedAt;

                // Update the data arrays
                var index = salesNames.indexOf(salesName);
                if (index !== -1) {
                    targetBrand[index] = parseInt('{{ $sales["target_brand"] }}');
                    achBrand[index] = parseInt('{{ $sales["ach_brand"] }}');
                } else {
                    salesNames.push(salesName);
                    targetBrand.push(parseInt('{{ $sales["target_brand"] }}'));
                    achBrand.push(parseInt('{{ $sales["ach_brand"] }}'));
                }
            }
        }
    @endforeach

    // Initialize chart for Target Brand and Achieved Brand for WARDAH
    var ctx2 = document.getElementById('myChartTavi').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Target Tavi',
                data: targetBrand,
                backgroundColor: '#FF7676',
                borderColor: '#FF7676',
                borderWidth: 1
            },
            {
                label: 'Achievement Tavi',
                data: achBrand,
                backgroundColor: '#FFCD4B',
                borderColor: '#FFCD4B',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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