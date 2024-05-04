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
        
        // Initialize variables for total plan call, actual call, and ecall
        var totalPlanCall = 0;
        var totalActualCall = 0;
        var totalECall = 0;

        // Calculate total plan call, actual call, and ecall
        data.forEach(function(item) {
            totalPlanCall += parseInt(item.totalPlanCall);
            totalActualCall += parseInt(item.actual_call);
            totalECall += parseInt(item.actual_ecall);
        });

        // Prepare data for doughnut chart
        var doughnutData = {
            labels: ['Total Plan Call', 'Total Actual Call', 'Total E-Call'],
            datasets: [{
                data: [totalPlanCall, totalActualCall, totalECall],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
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
    </div>

    <div class="row">
        <!-- Plan E-Call VS Actual E-Call Chart -->
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
        // Data for the chart (sales names, planned calls, and actual calls)
        var salesNames = [];
        var planCall = [];
        var actualCall = [];

        // Loop to populate data
        @foreach($dataScore as $score)
            salesNames.push('{{ $score["sales_name"] }}');
            planCall.push('{{ $score["plan_call"] }}');
            actualCall.push('{{ $score["actual_call"] }}');
        @endforeach

        // Initialize chart in the specified canvas
        var ctx1 = document.getElementById('myAreaChartScore1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar', // Default type is bar for mixed chart types
            data: {
                labels: salesNames,
                datasets: [{
                    label: 'Plan Call',
                    data: planCall,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    type: 'bar' // Bar chart for Plan Calls
                },
                {
                    label: 'Actual Call',
                    data: actualCall,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    type: 'line', // Line chart for Actual Calls
                    fill: false
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

        // Data for the chart (sales names, target e-call, and actual e-call)
        var salesName = [];
        var targetECall = [];
        var actualECall = [];

        // Loop to populate data
        @foreach($dataScore as $score)
            salesName.push('{{ $score["sales_name"] }}');
            targetECall.push('{{ $score["target_ecall"] }}');
            actualECall.push('{{ $score["actual_ecall"] }}');
        @endforeach

        // Initialize chart
        var ctx2 = document.getElementById('myAreaChartScore2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar', // Default type is bar for mixed chart types
            data: {
                labels: salesName,
                datasets: [{
                    label: 'Plan E-Call',
                    data: targetECall,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', // Slightly more opacity for better visibility
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    type: 'bar' // Specify bar chart type
                },
                {
                    label: 'Actual E-Call',
                    data: actualECall,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Maintain transparency for the line chart
                    borderWidth: 2,
                    type: 'line', // Specify line chart type
                    fill: false // No fill for line chart
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
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>RAO
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Plan Call
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Actual Call
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Effective Call
                                    <span class="sortable-icon">
                                        <i class="fas fa-sort"></i>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataScore as $score)
                            <tr>
                                <td style="border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $score['sales_name'] }}</td>
                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $score['jumlah_rao'] }}</td>
                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $score['plan_call'] }}</td>
                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $score['actual_call'] }}</td>
                                <td style="text-align: center; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $score['actual_ecall'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
        </div>
</main>
@endsection
