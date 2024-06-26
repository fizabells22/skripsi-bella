@extends('layouts.main-layout-user')
@section('title','Report | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<main>
    <style>
        .custom-card-body {
            max-height: 315px;
            overflow-y: auto;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
        <!-- Master Data Table for ALL BRAND -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Master Data All Brand</h6>
                </div>
                <br>
            <div class="col-12">
            <input type="date" id="datePicker" class="form-control">
        </div>
                <div class="card-body custom-card-body">
                    <table style="width: 100%; height: 100%">
                        <thead>
                            <tr>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target All Brand
                                    </span>
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                                </th>
                                <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                                </th>
                            </tr>
                        </thead>
                        <tr>
                        <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBody">
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<script>
    var salesData = @json($dataSales);

    function updateTable(date) {
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'ALL BRAND' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChart(salesNames, targetBrand, achBrand);
    }

    function updateChart(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartallbrand').getContext('2d');
        if (window.myChart) {
            window.myChart.destroy();
        }
        window.myChart = new Chart(ctx, {
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
                    label: 'Achievement All Brand',
                    data: achBrand,
                    backgroundColor: '#68D2E8',
                    borderColor: '#68D2E8',
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
    }

    document.getElementById('datePicker').addEventListener('change', function() {
        updateTable(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePicker').value = today;

    // Update table and chart on page load with today's data
    updateTable(today);
</script>

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
                <canvas id="myAreaChartwardah"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for WARDAH -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Wardah</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerWardah" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Wardah
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyWardah">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableWardah(date) {
        var tableBody = document.getElementById('tableBodyWardah');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'WARDAH' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartWardah(salesNames, targetBrand, achBrand);
    }

    function updateChartWardah(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartwardah').getContext('2d');
        if (window.myChartWardah) {
            window.myChartWardah.destroy();
        }
        window.myChartWardah = new Chart(ctx, {
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
    }

    document.getElementById('datePickerWardah').addEventListener('change', function() {
        updateTableWardah(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerWardah').value = today;

    // Update table and chart on page load with today's data
    updateTableWardah(today);
</script>
        
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
                <canvas id="myAreaChartemina"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for EMINA -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Emina</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerEmina" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Emina
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyEmina">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableEmina(date) {
        var tableBody = document.getElementById('tableBodyEmina');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'EMINA' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartEmina(salesNames, targetBrand, achBrand);
    }

    function updateChartEmina(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartemina').getContext('2d');
        if (window.myChartEmina) {
            window.myChartEmina.destroy();
        }
        window.myChartEmina = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: salesNames,
                datasets: [{
                    label: 'Target Emina',
                    data: targetBrand,
                    backgroundColor: '#FF9E9E',
                    borderColor: '#FFCAC8',
                    borderWidth: 1
                }, {
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
    }

    document.getElementById('datePickerEmina').addEventListener('change', function() {
        updateTableEmina(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerEmina').value = today;

    // Update table and chart on page load with today's data
    updateTableEmina(today);
</script>

            <!-- ACH MAKEOVER -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement MakeOver</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-areamakeover">
                <canvas id="myAreaChartmakeover"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for MAKEOVER -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data MakeOver</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerMakeover" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target MakeOver
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyMakeover">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableMakeover(date) {
        var tableBody = document.getElementById('tableBodyMakeover');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'MAKEOVER' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartMakeover(salesNames, targetBrand, achBrand);
    }

    function updateChartMakeover(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartmakeover').getContext('2d');
        if (window.myChartMakeover) {
            window.myChartMakeover.destroy();
        }
        window.myChartMakeover = new Chart(ctx, {
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
    }

    document.getElementById('datePickerMakeover').addEventListener('change', function() {
        updateTableMakeover(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerMakeover').value = today;

    // Update table and chart on page load with today's data
    updateTableMakeover(today);
</script>

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
                <canvas id="myAreaChartomg"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for OMG -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data OMG</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerOmg" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target OMG
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyOmg">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableOmg(date) {
        var tableBody = document.getElementById('tableBodyOmg');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'OMG' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartOmg(salesNames, targetBrand, achBrand);
    }

    function updateChartOmg(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartomg').getContext('2d');
        if (window.myChartOmg) {
            window.myChartOmg.destroy();
        }
        window.myChartOmg = new Chart(ctx, {
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
    }

    document.getElementById('datePickerOmg').addEventListener('change', function() {
        updateTableOmg(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerOmg').value = today;

    // Update table and chart on page load with today's data
    updateTableOmg(today);
</script>

<!-- Area Chart for PUTRI -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement Putri</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-areaputri">
                <canvas id="myAreaChartputri"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for PUTRI -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Putri</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerPutri" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Putri
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyPutri">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTablePutri(date) {
        var tableBody = document.getElementById('tableBodyPutri');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'PUTRI' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartPutri(salesNames, targetBrand, achBrand);
    }

    function updateChartPutri(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartputri').getContext('2d');
        if (window.myChartPutri) {
            window.myChartPutri.destroy();
        }
        window.myChartPutri = new Chart(ctx, {
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
    }

    document.getElementById('datePickerPutri').addEventListener('change', function() {
        updateTablePutri(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerPutri').value = today;

    // Update table and chart on page load with today's data
    updateTablePutri(today);
</script>

            <!-- ACH KAHF -->
<!-- Area Chart for KAHF -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement KAHF</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-areakahf">
                <canvas id="myAreaChartkahf"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for KAHF -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Kahf</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerKahf" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Kahf
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyKahf">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableKahf(date) {
        var tableBody = document.getElementById('tableBodyKahf');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'KAHF' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartKahf(salesNames, targetBrand, achBrand);
    }

    function updateChartKahf(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartkahf').getContext('2d');
        if (window.myChartKahf) {
            window.myChartKahf.destroy();
        }
        window.myChartKahf = new Chart(ctx, {
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
    }

    document.getElementById('datePickerKahf').addEventListener('change', function() {
        updateTableKahf(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerKahf').value = today;

    // Update table and chart on page load with today's data
    updateTableKahf(today);
</script>

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
                <canvas id="myAreaChartinstaperfect"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for INSTAPERFECT -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Instaperfect</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerInstaperfect" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Instaperfect
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyInstaperfect">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableInstaperfect(date) {
        var tableBody = document.getElementById('tableBodyInstaperfect');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'INSTAPERFECT' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartInstaperfect(salesNames, targetBrand, achBrand);
    }

    function updateChartInstaperfect(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartinstaperfect').getContext('2d');
        if (window.myChartInstaperfect) {
            window.myChartInstaperfect.destroy();
        }
        window.myChartInstaperfect = new Chart(ctx, {
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
    }

    document.getElementById('datePickerInstaperfect').addEventListener('change', function() {
        updateTableInstaperfect(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerInstaperfect').value = today;

    // Update table and chart on page load with today's data
    updateTableInstaperfect(today);
</script>

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
                <canvas id="myAreaChartcrystallure"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for CRYSTALLURE -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Crystallure</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerCrystallure" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Crystallure
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyCrystallure">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableCrystallure(date) {
        var tableBody = document.getElementById('tableBodyCrystallure');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'CRYSTALLURE' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartCrystallure(salesNames, targetBrand, achBrand);
    }

    function updateChartCrystallure(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartcrystallure').getContext('2d');
        if (window.myChartCrystallure) {
            window.myChartCrystallure.destroy();
        }
        window.myChartCrystallure = new Chart(ctx, {
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
    }

    document.getElementById('datePickerCrystallure').addEventListener('change', function() {
        updateTableCrystallure(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerCrystallure').value = today;

    // Update table and chart on page load with today's data
    updateTableCrystallure(today);
</script>


        <!-- ACH BIODEF -->
<!-- Area Chart for BIODEF -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement Biodef</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-areabiodef">
                <canvas id="myAreaChartbiodef"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for BIODEF -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Biodef</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerBiodef" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Biodef
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyBiodef">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableBiodef(date) {
        var tableBody = document.getElementById('tableBodyBiodef');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'BIODEF' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartBiodef(salesNames, targetBrand, achBrand);
    }

    function updateChartBiodef(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartbiodef').getContext('2d');
        if (window.myChartBiodef) {
            window.myChartBiodef.destroy();
        }
        window.myChartBiodef = new Chart(ctx, {
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
    }

    document.getElementById('datePickerBiodef').addEventListener('change', function() {
        updateTableBiodef(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerBiodef').value = today;

    // Update table and chart on page load with today's data
    updateTableBiodef(today);
</script>

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
                <canvas id="myAreaChartwonderly"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for WONDERLY -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Wonderly</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerWonderly" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Wonderly
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyWonderly">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableWonderly(date) {
        var tableBody = document.getElementById('tableBodyWonderly');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'WONDERLY' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartWonderly(salesNames, targetBrand, achBrand);
    }

    function updateChartWonderly(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartwonderly').getContext('2d');
        if (window.myChartWonderly) {
            window.myChartWonderly.destroy();
        }
        window.myChartWonderly = new Chart(ctx, {
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
    }

    document.getElementById('datePickerWonderly').addEventListener('change', function() {
        updateTableWonderly(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerWonderly').value = today;

    // Update table and chart on page load with today's data
    updateTableWonderly(today);
</script>

                <!-- ACH LABORE -->
<!-- Area Chart for LABORE -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement Labore</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-arealabore">
                <canvas id="myAreaChartlabore"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for LABORE -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Labore</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerLabore" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Labore
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyLabore">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableLabore(date) {
        var tableBody = document.getElementById('tableBodyLabore');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'LABORE' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartLabore(salesNames, targetBrand, achBrand);
    }

    function updateChartLabore(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaChartlabore').getContext('2d');
        if (window.myChartLabore) {
            window.myChartLabore.destroy();
        }
        window.myChartLabore = new Chart(ctx, {
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
    }

    document.getElementById('datePickerLabore').addEventListener('change', function() {
        updateTableLabore(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerLabore').value = today;

    // Update table and chart on page load with today's data
    updateTableLabore(today);
</script>

            <!-- ACH TAVI -->
<!-- Area Chart for TAVI -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Achievement Tavi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-areatavi">
                <canvas id="myAreaCharttavi"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Master Data Table for TAVI -->
<div class="col-xl-4 col-lg-6">
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Master Data Tavi</h6>
        </div>
        <br>
        <div class="col-12">
            <input type="date" id="datePickerTavi" class="form-control">
        </div>
        <div class="card-body custom-card-body">
            <table style="width: 100%; height: 100%">
                <thead>
                    <tr>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6;" data-sortable>Sales Name
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Target Tavi
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 50%;" data-sortable>Pencapaian
                        </th>
                        <th style="text-align: center; border-bottom: 1px solid #dee2e6; width: 20%;" data-sortable>Achievement
                        </th>
                    </tr>
                </thead>
                <tr>
                <tbody style="border-bottom: 1px solid #dee2e6; font-size: 14px;" id="tableBodyTavi">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var salesData = @json($dataSales);

    function updateTableTavi(date) {
        var tableBody = document.getElementById('tableBodyTavi');
        tableBody.innerHTML = '';

        var filteredData = salesData.filter(function(sales) {
            return sales.brand_name === 'TAVI' && sales.updated_at.startsWith(date);
        });

        var salesNames = [];
        var targetBrand = [];
        var achBrand = [];

        filteredData.forEach(function(sales) {
            var row = tableBody.insertRow();
            row.style.borderBottom = '1px solid #dee2e6';
            row.insertCell(0).innerText = sales.sales_name;
            row.insertCell(1).innerText = parseInt(sales.target_brand, 10).toLocaleString();
            row.insertCell(2).innerText = parseInt(sales.ach_brand, 10).toLocaleString();
            row.insertCell(3).innerText = (parseFloat(sales.persen_brand) * 100).toFixed(2) + '%';

            // Update chart data
            salesNames.push(sales.sales_name);
            targetBrand.push(parseInt(sales.target_brand, 10));
            achBrand.push(parseInt(sales.ach_brand, 10));
        });

        updateChartTavi(salesNames, targetBrand, achBrand);
    }

    function updateChartTavi(salesNames, targetBrand, achBrand) {
        var ctx = document.getElementById('myAreaCharttavi').getContext('2d');
        if (window.myChartTavi) {
            window.myChartTavi.destroy();
        }
        window.myChartTavi = new Chart(ctx, {
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
    }

    document.getElementById('datePickerTavi').addEventListener('change', function() {
        updateTableTavi(this.value);
    });

    // Set initial date to today
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('datePickerTavi').value = today;

    // Update table and chart on page load with today's data
    updateTableTavi(today);
</script>

    </main>
@endsection