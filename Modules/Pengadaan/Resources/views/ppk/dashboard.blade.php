@extends('adminlte::page')

@section('title', 'Dashboard PPK')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    Distribusi Status Pengadaan
                </div>
                <div class="card-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    Jenis Pengadaan
                </div>
                <div class="card-body">
                    <canvas id="jenisPengadaanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    Jumlah Pengadaan per Unit
                </div>
                <div class="card-body">
                    <canvas id="unitChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var ctx1 = document.getElementById('statusChart').getContext('2d');
        var statusCounts = @json($statusCounts);
        var labels1 = [];
        var data1 = [];
        var backgroundColors1 = [];

        statusCounts.forEach(function(statusCount) {
            labels1.push(statusCount.nama_status);
            data1.push(statusCount.total);
            backgroundColors1.push('rgba(' + Math.floor(Math.random() * 255) + ',' +
                Math.floor(Math.random() * 255) + ',' +
                Math.floor(Math.random() * 255) + ', 0.2)');
        });

        var statusChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: labels1,
                datasets: [{
                    label: '# of Status',
                    data: data1,
                    backgroundColor: backgroundColors1,
                    borderColor: backgroundColors1.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        var ctx2 = document.getElementById('unitChart').getContext('2d');
        var unitCounts = @json($unitCounts);
        var labels2 = [];
        var data2 = [];
        var backgroundColors2 = [];

        unitCounts.forEach(function(unitCount) {
            labels2.push(unitCount.nama);
            data2.push(unitCount.total);
            backgroundColors2.push('rgba(' + Math.floor(Math.random() * 255) + ',' +
                Math.floor(Math.random() * 255) + ',' +
                Math.floor(Math.random() * 255) + ', 0.2)');
        });

        var unitChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: labels2,
                datasets: [{
                    label: '# of Pengadaan',
                    data: data2,
                    backgroundColor: backgroundColors2,
                    borderColor: backgroundColors2.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx3 = document.getElementById('jenisPengadaanChart').getContext('2d');
        var jenisPengadaanCounts = @json($jenisPengadaanCounts);
        var labels3 = [];
        var data3 = [];
        var backgroundColors3 = [];

        jenisPengadaanCounts.forEach(function(jenisPengadaanCount) {
            labels3.push(jenisPengadaanCount.nama_jenis);
            data3.push(jenisPengadaanCount.total);
            backgroundColors3.push('rgba(' + Math.floor(Math.random() * 255) + ',' +
                Math.floor(Math.random() * 255) + ',' +
                Math.floor(Math.random() * 255) + ', 0.2)');
        });

        var jenisPengadaanChart = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: labels3,
                datasets: [{
                    label: '# of Jenis Pengadaan',
                    data: data3,
                    backgroundColor: backgroundColors3,
                    borderColor: backgroundColors3.map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
@stop