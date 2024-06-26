@extends('layouts.main-layout')
@section('title', 'Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h2 class="m-0 font-weight-bold text-primary">Report Lighthouse</h2>
        <div class="container-fluid">
        <!-- Content Row -->
        <br>
        <div class="row">
            <div class="d-sm-flex align-items-center mb-4">
                <a href="{{ route('download.template') }}" style="margin-right: 20px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Template</a>
                <a href="{{ route('import') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-upload fa-sm text-white-50"></i> File Upload</a>
            </div>
        </div>
    </div>

    <!-- Date Picker Control -->
    <div class="row mb-3">
        <div class="col-12">
            <form id="dateForm" method="GET" action="{{ route('reportadmin') }}">
                <label for="datePicker" class="form-label">Select Date:</label>
                <input type="date" id="datePicker" name="selected_date" class="form-control" value="{{ $data['selectedDate'] }}">
            </form>
        </div>
    </div>
    <!-- Chart Containers -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Products by Value</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body custom-card-body">
                    <div class="chart-area">
                        <canvas id="barChartByValue"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Products by Customers</h6>
                </div>
                <div class="card-body">
                    <!-- Card Body -->
                    <div class="custom-card-pie">
                        <div class="chart-pie">
                            <canvas id="doughnutChartByCustomers" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Distribution by Month</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="lineChartByMonth"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var barChartData = @json($data['barChartData']);
        var doughnutChartData = @json($data['doughnutChartData']);
        var lineChartData = @json($data['lineChartData']);
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        // Mengurutkan lineChartData berdasarkan bulan dari terkecil ke terbesar
        lineChartData.sort((a, b) => {
            return monthNames.indexOf(a.month) - monthNames.indexOf(b.month);
        });

        // Update bar chart
        var ctxValue = document.getElementById('barChartByValue').getContext('2d');
        var barChartByValue = new Chart(ctxValue, {
            type: 'bar',
            data: {
                labels: barChartData.map(item => item.product_name.length > 30 ? item.product_name.substring(0, 30) + '...' : item.product_name),
                datasets: [{
                    label: 'Total Delivered Value',
                    data: barChartData.map(item => item.total_delivered),
                    backgroundColor: '#FAA300',
                    borderColor: '#FAA300',
                    borderWidth: 1
                }]
            },
            options: {
                layout: {
                    padding: {
                        left: 50,
                        right: 50,
                        top: 0,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            position: 'right'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: 'black',
                        formatter: function(value, context) {
                            return value;
                        }
                    }
                }
            }
        });

            var barChartContainer = document.querySelector('.custom-card-pie');
        barChartContainer.style.height = '320px'; // Adjust height as needed
        barChartContainer.style.overflowY = 'auto'; // Add overflow-y auto if necessary
        // Update doughnut chart
        var ctxCustomers = document.getElementById('doughnutChartByCustomers').getContext('2d');
        var doughnutChartByCustomers = new Chart(ctxCustomers, {
            type: 'doughnut',
            data: {
                labels: doughnutChartData.map(item => item.product_name.length > 30 ? item.product_name.substring(0, 25) + '...' : item.product_name),
                datasets: [{
                    label: 'Total Customers',
                    data: doughnutChartData.map(item => item.total_purchases),
                    backgroundColor: [
                        '#59D5E0',
                        '#FAA300',
                        '#F4538A',
                        '#277BC0',
                        '#DC8449'
                    ],
                    borderColor: [
                        '#59D5E0',
                        '#FAA300',
                        '#F4538A',
                        '#277BC0',
                        '#DC8449'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                layout: {
                    padding: {
                        left: 10,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                legend: {
                    position: 'bottom',
                    align: 'start',
                },
                plugins: {
                    datalabels: {
                        display: false
                    }
                }
            }
        });

        // Update line chart
        var ctxLine = document.getElementById('lineChartByMonth').getContext('2d');
        var lineChartByMonth = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: lineChartData.map(item => item.month),
                datasets: [{
                    label: 'Total Sales',
                    data: lineChartData.map(item => item.totalSales),
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        },
                        gridLines: {
                            color: 'rgb(234, 236, 244)',
                            zeroLineColor: 'rgb(234, 236, 244)',
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: 'rgb(255,255,255)',
                    bodyFontColor: '#858796',
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp ' + tooltipItem.yLabel.toLocaleString();
                        }
                    }
                }
            }
        });

        // Add event listener to update charts on date change
        var datePicker = document.getElementById('datePicker');
        datePicker.addEventListener('change', function() {
            document.getElementById('dateForm').submit();
        });
    });
</script>
@endsection
