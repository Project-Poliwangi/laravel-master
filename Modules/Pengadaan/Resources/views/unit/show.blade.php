@extends('adminlte::page')
@section('title', 'Dokumen')
@section('content_header')
    <h1 class="m-0 text-dark">
    </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Detail Dokumen</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Dokumen KAK </th>
                                    <td>
                                        @if ($pengadaan->dokumen_kak)
                                            <a href="{{ asset('storage/assets/dokumen/dokumen_kak/' . $pengadaan->dokumen_kak) }}"
                                                target="_blank">Lihat Dokumen</a>
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Dokumen HPS </th>
                                    <td>
                                        @if ($pengadaan->dokumen_hps)
                                            <a href="{{ asset('storage/assets/dokumen/dokumen_hps/' . $pengadaan->dokumen_hps) }}"
                                                target="_blank">Lihat Dokumen</a>
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Dokumen Stock Opname </th>
                                    <td>
                                        @if ($pengadaan->dokumen_stock_opname)
                                            <a href="{{ asset('storage/assets/dokumen/dokumen_stock_opname/' . $pengadaan->dokumen_stock_opname) }}"
                                                target="_blank">Lihat Dokumen</a>
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Dokumen Surat Ijin Impor </th>
                                    <td>
                                        @if ($pengadaan->dokumen_surat_ijin_impor)
                                            <a href="{{ asset('storage/assets/dokumen/dokumen_surat_ijin_impor/' . $pengadaan->dokumen_surat_ijin_impor) }}"
                                                target="_blank">Lihat Dokumen</a>
                                        @else
                                            Tidak ada dokumen
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back();"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        // Register FilePond plugin
        FilePond.registerPlugin();

        // Turn all file input elements into ponds
        FilePond.create(document.querySelector('.basic-filepond'));
    </script>
@endsection
