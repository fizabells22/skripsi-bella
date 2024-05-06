@extends('layouts.main-layout')
@section('title', 'Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h2 class="m-0 font-weight-bold text-primary">Report Lighthouse</h2>
    <div class="container-fluid">
        <!-- Content Row -->
        <br>
        <div class="row">
            <div class="d-sm-flex align-items-center mb-4">
                <a href="{{ route('download.template') }}" style="margin-right: 20px;"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Download Template</a>
                <a href="{{ route('import') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-upload fa-sm text-white-50"></i> File Upload</a>
            </div>
        </div>
    </div>
        <!-- Bar Chart: Top 5 Products by Value -->
        <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Top 5 Products by Value</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="barChartByValue"></canvas>
            </div>
            <script>
                var ctxValue = document.getElementById('barChartByValue').getContext('2d');
                var barChartByValue = new Chart(ctxValue, {
                    type: 'bar',
                    data: {
                        labels: [
                            @foreach($formattedTopProductsByDelivered as $product)
                                '{{ \Illuminate\Support\Str::limit($product['product_name'], 30) }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Total Delivered Value',
                            data: [
                                @foreach($formattedTopProductsByDelivered as $product)
                                    {{ $product['total_delivered'] }},
                                @endforeach
                            ],
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    position: 'right' // Positioning product names on the right side
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>

        <!-- Bar Chart: Top 5 Products by Number of Customers -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Products by Number of Customers</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="barChartByCustomers"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctxCustomers = document.getElementById('barChartByCustomers').getContext('2d');
        var barChartByCustomers = new Chart(ctxCustomers, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($formattedTopProductsByCustomerPurchases as $product)
                        '{{ $product['product_name'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Number of Customers',
                    data: [
                        @foreach($formattedTopProductsByCustomerPurchases as $product)
                            {{ $product['total_purchases'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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
</main>
@endsection
