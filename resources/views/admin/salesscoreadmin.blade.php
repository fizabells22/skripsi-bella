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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h2 class="m-0 font-weight-bold text-primary">Report Sales Scoreboard</h2>
    <div class="container-fluid">
        <!-- Content Row -->
        <br>
        <div class="row">
            <div class="d-sm-flex align-items-center mb-4">
                <a href="{{ route('download.template3') }}" style="margin-right: 20px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Download Template</a>
                <a href="{{ route('importsales') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-upload fa-sm text-white-50"></i> File Upload</a>
            </div>
        </div>
    </div>
        
    <div class="row">
        <!-- Plan Call VS Actual Call Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Plan Call VS Actual Call</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-areascore1">
                        <canvas id="myAreaChartScore1"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4 custom-card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Summary Plan Call</h6>
            </div>
            <div class="card-body custom-card-body">
                <canvas id="salesChart" width="350" height="390"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    // Get data from PHP (you may need to modify the data format depending on how you pass it)
    var data = <?php echo json_encode($dataScore); ?>;
    
    // Initialize objects to track unique sales names and their corresponding values
    var uniqueSalesNames = {};
    var totalPlanCall = {};
    var totalActualCall = {};
    var totalECall = {};

    // Calculate total plan call, actual call, and ecall
    data.forEach(function(item) {
        // Check if sales name has been processed
        if (!uniqueSalesNames.hasOwnProperty(item.sales_name)) {
            // If not, add it to the uniqueSalesNames object
            uniqueSalesNames[item.sales_name] = true;
            // Initialize total values for this sales name
            totalPlanCall[item.sales_name] = 0;
            totalActualCall[item.sales_name] = 0;
            totalECall[item.sales_name] = 0;
        }
        // Update the totals for this sales name
        totalPlanCall[item.sales_name] = parseInt(item.totalPlanCall);
        totalActualCall[item.sales_name] = parseInt(item.actual_call);
        totalECall[item.sales_name] = parseInt(item.actual_ecall);
    });

    // Calculate overall totals
    var overallTotalPlanCall = Object.values(totalPlanCall).reduce((a, b) => a + b, 0);
    var overallTotalActualCall = Object.values(totalActualCall).reduce((a, b) => a + b, 0);
    var overallTotalECall = Object.values(totalECall).reduce((a, b) => a + b, 0);

    // Prepare data for doughnut chart
    var doughnutData = {
        labels: ['Total Plan Call', 'Total Actual Call', 'Total E-Call'],
        datasets: [{
            data: [overallTotalPlanCall, overallTotalActualCall, overallTotalECall],
            backgroundColor: [
                '#59D5E0',
                '#FAA300',
                '#F4538A',
            ],
            borderWidth: 1
        }]
    };

    // Draw doughnut chart
    var salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'doughnut',
        data: doughnutData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Total Plan Call, Actual Call, and E-Call'
            }
        }
    });
</script>

    <div class="row">
        <!-- Plan Call VS Actual Call Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Plan E-Call VS Actual E-Call</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-areascore2">
                        <canvas id="myAreaChartScore2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script>
    // Initialize empty arrays to store data
    var salesNames = [];
    var planCall = [];
    var actualCall = [];
    var targetECall = [];
    var actualECall = [];

    // Initialize an object to track the latest updated_at for each sales name
    var latestUpdate = {};

    // Loop through the data to update the arrays with the latest values and track the latest updated_at for each sales name
    @foreach($dataScore as $score)
        var salesName = '{{ $score["sales_name"] }}';
        var updatedAt = '{{ $score["updated_at"] }}';

        // Check if the sales name is already in the array and if the current data has a newer updated_at
        if (!latestUpdate[salesName] || updatedAt > latestUpdate[salesName]) {
            // Update the latest updated_at for the sales name
            latestUpdate[salesName] = updatedAt;

            // Update the data arrays
            var index = salesNames.indexOf(salesName);
            if (index !== -1) {
                planCall[index] = parseInt('{{ $score["plan_call"] }}');
                actualCall[index] = parseInt('{{ $score["actual_call"] }}');
                targetECall[index] = parseInt('{{ $score["target_ecall"] }}');
                actualECall[index] = parseInt('{{ $score["actual_ecall"] }}');
            } else {
                salesNames.push(salesName);
                planCall.push(parseInt('{{ $score["plan_call"] }}'));
                actualCall.push(parseInt('{{ $score["actual_call"] }}'));
                targetECall.push(parseInt('{{ $score["target_ecall"] }}'));
                actualECall.push(parseInt('{{ $score["actual_ecall"] }}'));
            }
        }
    @endforeach

    // Initialize chart for Plan Call and Actual Call
    var ctx1 = document.getElementById('myAreaChartScore1').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Plan Call',
                data: planCall,
                backgroundColor: '#59D5E0',
                borderColor: '#59D5E0',
                borderWidth: 1
            },
            {
                label: 'Actual Call',
                data: actualCall,
                backgroundColor: '#FAA300',
                borderColor: '#FAA300',
                borderWidth: 2
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

    // Initialize chart for Plan E-Call and Actual E-Call
    var ctx2 = document.getElementById('myAreaChartScore2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: salesNames,
            datasets: [{
                label: 'Plan E-Call',
                data: targetECall,
                backgroundColor: '#FEA1A1',
                borderColor: '#FEA1A1',
                borderWidth: 1
            },
            {
                label: 'Actual E-Call',
                data: actualECall,
                backgroundColor: '#F4538A',
                borderColor: '#F4538A',
                borderWidth: 2
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

<!-- Table Master -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data</h6>
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
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>RAO
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Plan Call
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Actual Call
                            <span class="sortable-icon">
                                <i class="fas fa-sort"></i>
                            </span>
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;"data-sortable>Effective Call
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
                    @foreach($dataScore as $score)
                        @if (!isset($salesData[$score['sales_name']]))
                            @php
                                $salesData[$score['sales_name']] = [
                                    'jumlah_rao' => 0,
                                    'plan_call' => 0,
                                    'actual_call' => 0,
                                    'actual_ecall' => 0
                                ];
                            @endphp
                        @endif
                        @php
                            // Update sales data with latest values
                            $salesData[$score['sales_name']]['jumlah_rao'] = $score['jumlah_rao'];
                            $salesData[$score['sales_name']]['plan_call'] = $score['plan_call'];
                            $salesData[$score['sales_name']]['actual_call'] = $score['actual_call'];
                            $salesData[$score['sales_name']]['actual_ecall'] = $score['actual_ecall'];
                        @endphp
                    @endforeach
                    @foreach($salesData as $salesName => $sales)
                        <tr>
                            <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $salesName }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $sales['jumlah_rao'] }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $sales['plan_call'] }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $sales['actual_call'] }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $sales['actual_ecall'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>
@endsection
