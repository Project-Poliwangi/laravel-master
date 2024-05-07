{{-- @extends('surat::layouts.master') --}}
@extends('adminlte::page')
@section('title', 'Arsip')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h4 class="card-title mb-4">Informasi Arsip Surat</h4>
                    </div>
                    <div class="d-flex flex-wrap gap-2 col-md-6 justify-content-end">
                        <a href="{{url('/surat/tambah')}}" type="button" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-plus label-icon"></i>Tambah Surat</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="tabel_surat">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 20px;">No</th>
                                <th class="align-middle text-center">Nomor Surat</th>
                                <th class="align-middle text-center">Pengirim</th>
                                <th class="align-middle text-center">Perihal</th>
                                <th class="align-middle text-center">Tanggal Surat</th>
                                <th class="align-middle text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arsip as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$loop->iteration}}
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">{{ $item->no_surat }}</a> </td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>
                                        {{ $item->perihal }}
                                    </td>
                                    <td>
                                        {{ date('d F Y', strtotime($item->tanggal_surat)) }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
        </div>
    </div>
</div>
<script>
    let table = new DataTable('#tabel_surat');
</script>
@endsection
