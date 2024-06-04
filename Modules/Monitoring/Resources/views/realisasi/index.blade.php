@extends('adminlte::page')
@section('title', 'Realisasi')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
    <div class="row">
        <div class="col-md-5">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fa fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">JUMLAH PROGRAM KERJA</span>
                    <span class="info-box-number">{{ $jumlahProgramKerja }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="far fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL BIAYA DPA</span>
                    <span class="info-box-number">Rp. {{ str_replace(',', '.', number_format($totalDPA)) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL RENCANA KEUANGAN</span>
                    <span class="info-box-number">1,410</span>
                </div>
                <span class="info-box-icon bg-success"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL REALISASI KEUANGAN</span>
                    <span class="info-box-number">1,410</span>
                </div>

                <div class="mt-auto mb-auto mr-3">
                    <button class="btn btn-light" type="button" id="toggleContentButton">
                        Detail <i class="fas fa-sort-down"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="dropdownContent" style="display: none;">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">RENCANA TERTIMBANG FISIK</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">REALISASI TERTIMBANG FISIK</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">DEVIASI</span>
                        <span class="info-box-number">1,410</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

        @include('monitoring::include.tabel_realisasi')
        
    </div>
    </div>
@endsection

@push('js')
    <script>
        document.getElementById("toggleContentButton").addEventListener("click", function() {
            var content = document.getElementById("dropdownContent");
            content.style.display = (content.style.display === "none") ? "block" : "none";
        });
    </script>
@endpush
