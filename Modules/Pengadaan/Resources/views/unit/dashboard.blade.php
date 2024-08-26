@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0 text-dark">Dashboard</h1>
        <form method="GET" action="{{ route('unit.index') }}" class="form-inline">
            <div class="form-group mr-2">
                <label for="tahun_anggaran" class="mr-2">Tahun Anggaran:</label>
                <select id="tahun_anggaran" name="tahun_anggaran" class="form-control">
                    <option value="">Semua Tahun</option>
                    @for ($year = date('Y'); $year >= 2011; $year--)
                        <option value="{{ $year }}" {{ $year == $tahunAnggaran ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
@stop

@section('content')
    {{-- Dashboard Card --}}
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Pengadaan</h6>
                            <span class="h2 font-weight-bold mb-0">{{ $totalPengadaan }}</span>
                        </div>
                        <div class="col-auto text-center">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="fas fa-box"></i> <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Pengadaan Berjalan</h6>
                            <span class="h2 font-weight-bold mb-0">{{ $pengadaanBerjalan }}</span>
                        </div>
                        <div class="col-auto text-center">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="fas fa-spinner"></i>
                                <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Pengadaan Selesai</h6>
                            <span class="h2 font-weight-bold mb-0">{{ $pengadaanSelesai }}</span>
                        </div>
                        <div class="col-auto text-center">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-check-circle"></i>
                                <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Jenis dan Metode --}}
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-muted text-center text-uppercase ls-1 mb-1">Jenis Pengadaan</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="jenisPengadaanChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-center text-muted ls-1 mb-1">Metode Pengadaan</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="metodePengadaanChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Status --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-center text-muted ls-1 mb-1">Status Pengadaan</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="statusPengadaanChart" class="chart-canvas-status"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('css')
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            /* Lebar ikon */
            height: 50px;
            /* Tinggi ikon */
            font-size: 24px;
            /* Ukuran font untuk ikon */
            border-radius: 50%;
            /* Membuat ikon bulat */
            margin-left: 20px;
            /* Jarak tambahan di sebelah kiri ikon untuk memindahkannya ke kanan */
        }

        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-body .row {
            width: 100%;
            align-items: center;
        }

        .chart-canvas-status {
            width: 100% !important;
            /* Mengatur lebar chart agar sesuai dengan kontainer */
            max-width: 800px;
            /* Maksimal lebar chart */
            height: 400px !important;
            /* Atur tinggi chart sesuai kebutuhan */
        }
    </style>
@stop

@section('js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const jenisPengadaanChart = document.getElementById('jenisPengadaanChart').getContext('2d');
        const metodePengadaanChart = document.getElementById('metodePengadaanChart').getContext('2d');
        const statusPengadaanChart = document.getElementById('statusPengadaanChart').getContext('2d');

        // Chart for Jenis Pengadaan
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
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 10 // Mengatur ukuran font lebih kecil
                            },
                            padding: 18, // Mengurangi padding antara label
                            boxWidth: 15, // Mengatur ukuran kotak warna label lebih kecil
                        },
                    },
                },
                layout: {
                    padding: {
                        bottom: 10
                    }
                }
            }
        });

        // Chart for Metode Pengadaan
        new Chart(metodePengadaanChart, {
            type: 'pie',
            data: {
                labels: {!! json_encode($metodePengadaanChart->pluck('label')) !!},
                datasets: [{
                    data: {!! json_encode($metodePengadaanChart->pluck('count')) !!},
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', ],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 10 // Mengatur ukuran font lebih kecil
                            },
                            padding: 10, // Mengurangi padding antara label
                            boxWidth: 10, // Mengatur ukuran kotak warna label lebih kecil
                        },
                    },
                },
                layout: {
                    padding: {
                        bottom: 10
                    }
                }
            }
        });

        new Chart(statusPengadaanChart, {
            type: 'bar',
            data: {
                labels: {!! json_encode($statusPengadaanChart->pluck('label')) !!},
                datasets: [{
                    data: {!! json_encode($statusPengadaanChart->pluck('count')) !!},
                    backgroundColor: ['#dc3545', // Pemenuhan Dokumen (badge-danger)
                        '#007bff', // Pemilihan Penyedia (badge-primary)
                        '#ffc107', // Kontrak (badge-warning)
                        '#28a745', // Serah Terima (badge-success)
                        ],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value.toFixed(0)}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop
