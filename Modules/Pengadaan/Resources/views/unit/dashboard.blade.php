@extends('adminlte::page')

@section('title', 'Dashboard Unit')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="container mt-4">
            <div class="row">
                @php
                    $status = [
                        'Belum Dalam Periode' => $belumDalamPeriode,
                        'Pra DIPA' => $praDipa,
                        'Pemenuhan Dokumen' => $pemenuhanDokumen,
                        'Pemilihan Penyedia' => $pemilihanPenyedia,
                        'Kontrak' => $kontrak,
                        'Serah Terima' => $serahTerima,
                    ];
                    $colors = ['secondary', 'info', 'danger', 'primary', 'warning', 'success'];
                    $icons = ['fas fa-calendar-times', 'fas fa-calendar-check', 'fas fa-file-alt', 'fas fa-user-tie', 'fas fa-file-signature', 'fas fa-handshake']; // Contoh ikon
                @endphp
    
                @foreach ($status as $statuses => $count)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card custom-card text-white bg-{{ $colors[$loop->index] }} h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $statuses }}</h5>
                                <p class="card-text">{{ $count }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Distribusi Pengadaan Berdasarkan Status
                        </div>
                        <div class="card-body">
                            <canvas id="pengadaanStatusChart"></canvas>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Distribusi Pengadaan Berdasarkan Jenis Pengadaan
                        </div>
                        <div class="card-body">
                            <canvas id="pengadaanJenisChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Line Chart -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Tren Pengadaan (Per Bulan)
                        </div>
                        <div class="card-body">
                            <canvas id="trenPengadaanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .icon-container {
            font-size: 4rem; /* Ukuran ikon */
            margin-bottom: 15px; /* Jarak bawah ikon */
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 2.5rem;
            font-weight: 600;
        }
    </style>
@stop

@section('js')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for charts
        const statusData = @json($statusDistribution);

        // Pengadaan Status Chart
        const pengadaanStatusChartCtx = document.getElementById('pengadaanStatusChart').getContext('2d');
        new Chart(pengadaanStatusChartCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(statusData),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: ['#6c757d', '#17a2b8', '#dc3545', '#007bff', '#ffc107', '#28a745'],
                }],
            },
        });
    </script>
@stop
