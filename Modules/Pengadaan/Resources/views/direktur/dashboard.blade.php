@extends('adminlte::page')
@section('title', 'Dashboard Direktur')
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
    <div class="row">
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
        {{-- <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Status dan Jenis Pengadaan</div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Unit dan Jumlah Pengadaan</div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="unitChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const jenisPengadaanChart = document.getElementById('jenisPengadaanChart').getContext('2d');
        const pengadaanStatusChart = document.getElementById('pengadaanStatusChart').getContext('2d');

        new Chart(jenisPengadaanChart, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_column($jenisPengadaanChart, 'label')) !!},
                datasets: [{
                    label: 'Jenis Pengadaan',
                    data: {!! json_encode(array_column($jenisPengadaanChart, 'count')) !!},
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

        new Chart(pengadaanStatusChart, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_column($pengadaanStatusChart, 'label')) !!},
                datasets: [{
                    label: 'Status Pengadaan',
                    data: {!! json_encode(array_column($pengadaanStatusChart, 'count')) !!},
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
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
@endsection
