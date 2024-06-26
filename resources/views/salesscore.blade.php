@extends('layouts.main-layout-user')
@section('title','Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<main>
  <style>
        .custom-card-body {
            max-height: 375px;
            overflow-y: auto;
        }
        td{
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            font-size: 14px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h2 class="m-0 font-weight-bold text-primary">Report Sales Scoreboard</h2>
        <br>
    <!-- Date Picker Control -->
    <div class="row mb-3">
        <div class="col-12">
            <label for="datePicker" class="form-label">Select Date:</label>
            <input type="date" id="datePicker" class="form-control">
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
    var salesData = <?php echo json_encode($dataScore); ?>;
    
    var salesChart, myChart1, myChart2; // Define global variables for chart instances

    function updateTable(data, selectedDate) {
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        // Filter data berdasarkan tanggal yang di-klik (selectedDate)
        var filteredData = data.filter(function(item) {
            // Ubah format tanggal untuk cocokkan dengan format data
            var itemDate = new Date(item.updated_at).toISOString().split('T')[0];
            return itemDate === selectedDate;
        });

        // Perbarui tabel dengan data yang telah difilter
        filteredData.forEach(function(item) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).textContent = item.sales_name;
            row.insertCell(1).textContent = item.jumlah_rao;
            row.insertCell(2).textContent = item.totalPlanCall;
            row.insertCell(3).textContent = item.actual_call;
            row.insertCell(4).textContent = item.actual_ecall;
        });
    }

function updateChartsAndTable(date) {
    // Update table based on selected date
    updateTable(salesData, date);

    // Filter data for chart based on selected date
    var filteredData = salesData.filter(function(item) {
        var itemDate = new Date(item.updated_at).toISOString().split('T')[0];
        return itemDate === date;
    });

    // Update chart data
    updateCharts(filteredData);
}

    function updateCharts(data) {
        var totalPlanCall = data.reduce(function(acc, curr) {
            return acc + parseInt(curr.totalPlanCall);
        }, 0);
        var totalActualCall = data.reduce(function(acc, curr) {
            return acc + parseInt(curr.actual_call);
        }, 0);
        var totalECall = data.reduce(function(acc, curr) {
            return acc + parseInt(curr.actual_ecall);
        }, 0);

        var doughnutData = {
            labels: ['Total Plan Call', 'Total Actual Call', 'Total E-Call'],
            datasets: [{
                data: [totalPlanCall, totalActualCall, totalECall],
                backgroundColor: ['#59D5E0', '#FAA300', '#F4538A'],
                borderWidth: 1
            }]
        };

        // Destroy existing chart before creating a new one
        if (salesChart) {
            salesChart.destroy();
        }
        salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'doughnut',
            data: doughnutData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                }
            }
        });

        var salesNames = [];
        var planCall = [];
        var actualCall = [];
        var targetECall = [];
        var actualECall = [];

        data.forEach(function(item) {
            salesNames.push(item.sales_name);
            planCall.push(parseInt(item.totalPlanCall));
            actualCall.push(parseInt(item.actual_call));
            targetECall.push(parseInt(item.target_ecall));
            actualECall.push(parseInt(item.actual_ecall));
        });

        var ctx1 = document.getElementById('myAreaChartScore1').getContext('2d');
        // Destroy existing chart before creating a new one
        if (myChart1) {
            myChart1.destroy();
        }
        myChart1 = new Chart(ctx1, {
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

        var ctx2 = document.getElementById('myAreaChartScore2').getContext('2d');
        // Destroy existing chart before creating a new one
        if (myChart2) {
            myChart2.destroy();
        }
        myChart2 = new Chart(ctx2, {
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
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date picker
        var datePicker = document.getElementById('datePicker');
        datePicker.addEventListener('change', function() {
            updateChartsAndTable(this.value);
        });

        // Set initial date to today
        var today = new Date().toISOString().split('T')[0];
        datePicker.value = today;

        // Update charts and table on page load
        updateChartsAndTable(today);
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
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>RAO
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Plan Call
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Actual Call
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Effective Call
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
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