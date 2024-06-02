{{-- @extends('layouts.master') --}}

@extends('adminlte::page')
@section('title', 'Dashboard')
@push('css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pegawai</span>
                    <span class="info-box-number">
                        10
                        <small>%</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-solid fa-chart-line"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Perencanaan</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-solid fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Program Kerja</span>
                    <span class="info-box-number">{{ $jumlahPerencanaan }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-liht fa-calendar-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Kegiatan</span>
                    <span class="info-box-number">{{ $jumlahSubPerencanaan }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- end-->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Realisasi Keuangan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Filter by Year -->
                            <div class="form-group">
                                <label for="yearSelect">Pilih Tahun:</label>
                                <select id="yearSelect" class="select2" style="width: 100%;">>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unitSelect">Pilih Unit:</label>
                                <select id="unitSelect" class="select2" style="width: 100%;">
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @include('monitoring::include.chart_realisasi')

                        @include('monitoring::include.progres')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Data</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        @include('monitoring::include.chart_serapan')
                    </div>
                    <div class="row mt-4">
                        @include('monitoring::include.tabel_unit')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
@endpush
