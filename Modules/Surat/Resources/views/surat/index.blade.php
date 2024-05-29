{{-- @extends('surat::layouts.master') --}}
@extends('adminlte::page')
@section('title', 'Surat')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Informasi Surat</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="d-flex flex-wrap gap-2 col-md-12 justify-content-end">
                        <a href="{{url('/surat/surat-masuk/create')}}" type="button" class="btn btn-primary waves-effect waves-light">
                            <i class="bx bx-plus label-icon"></i>Tambah Surat</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" id="tabel_surat">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 20px;">No</th>
                                <th class="align-middle text-center">Induk</th>
                                <th class="align-middle text-center">Nomor Surat</th>
                                <th class="align-middle text-center">Tanggal Surat</th>
                                <th class="align-middle text-center">Pengirim</th>
                                <th class="align-middle text-center">Perihal</th>
                                <th class="align-middle text-center">Sifat</th>
                                <th class="align-middle text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat as $item)
                                <tr>
                                    <td class="text-center">
                                        {{$loop->iteration}}
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">{{ $item->induk }}</a> </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">{{ $item->nomor }}</a> </td>
                                    <td>
                                        {{ date('d F Y', strtotime($item->tanggal_surat)) }}
                                    </td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>
                                        {{ $item->perihal }}
                                    </td>
                                    <td>
                                        {{ $item->sifat }}
                                    </td>
                                    
                                    {{-- <td class="text-center">
                                        @if ($item->tujuan_disposisi != null)   
                                        {{ $item->tujuan_disposisi }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                        <span class="badge bg-danger font-size-11">Perlu Disposisi</span>
                                        @else
                                        <span class="badge bg-secondary font-size-11">Arsip</span>
                                        @endif
                                    </td> --}}
                                    <td class="text-center">
                                        <!-- Button trigger modal -->
                                        <a href="{{url('surat/surat-masuk/' .$item->id. '/edit')}}"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button></a>
                                        <button type="button" class="btn btn-sm btn-danger" ><i class="fas fa-trash"></i></button>
                                        <a href="{{url('surat/surat-masuk/' .$item->id)}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button></a>
                                        <button type="button" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i></button>
                                        <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-file-archive"></i></button>
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
