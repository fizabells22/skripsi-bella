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

        <!-- Sales Table -->
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
                    label: 'Target E-Call',
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
</main>
@endsection
