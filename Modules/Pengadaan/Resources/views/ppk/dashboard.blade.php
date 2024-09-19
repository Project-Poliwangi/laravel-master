@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header text-center">Total Pengadaan</div>
                <div class="card-body d-flex justify-content-center">
                    <h5 class="card-title">{{ $totalPengadaan }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header text-center">Pengadaan Tahun Ini</div>
                <div class="card-body d-flex justify-content-center">
                    <h5 class="card-title">{{ $pengadaanBaru }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header text-center">Pengadaan Selesai Tahun Ini</div>
                <div class="card-body d-flex justify-content-center">
                    <h5 class="card-title">{{ $pengadaanSelesai }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Distribusi Status Pengadaan
                </div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="pengadaanStatusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Jenis Pengadaan
                </div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="jenisPengadaanChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Metode Pengadaan
                </div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="metodePengadaanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const pengadaanStatusChart = document.getElementById('pengadaanStatusChart').getContext('2d');
        const jenisPengadaanChart = document.getElementById('jenisPengadaanChart').getContext('2d');
        const metodePengadaanChart = document.getElementById('metodePengadaanChart').getContext('2d');

        new Chart(pengadaanStatusChart, {
            type: 'pie',
            data: {
                labels: {!! json_encode($pengadaanStatusChart->pluck('label')) !!},
                datasets: [{
                    data: {!! json_encode($pengadaanStatusChart->pluck('count')) !!},
                    backgroundColor: [
                        '#dc3545', // Pemenuhan Dokumen (badge-danger)
                        '#007bff', // Pemilihan Penyedia (badge-primary)
                        '#ffc107', // Kontrak (badge-warning)
                        '#28a745', // Serah Terima (badge-success)
                        '#6c757d', // Default/other statuses (badge-secondary)
                    ], 
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        new Chart(jenisPengadaanChart, {
            type: 'pie',
            data: {
                labels: {!! json_encode($jenisPengadaanChart->pluck('label')) !!},
                datasets: [{
                    data: {!! json_encode($jenisPengadaanChart->pluck('count')) !!},
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        new Chart(metodePengadaanChart, {
            type: 'pie',
            data: {
                labels: {!! json_encode($metodePengadaanChart->pluck('label')) !!},
                datasets: [{
                    data: {!! json_encode($metodePengadaanChart->pluck('count')) !!},
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
@stop
