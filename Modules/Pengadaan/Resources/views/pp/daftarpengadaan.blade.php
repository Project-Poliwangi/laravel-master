@extends('adminlte::page')
@section('title', 'Daftar Pengadaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="m-0 text-dark">Daftar Pengadaan</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ url('/pp') }}" accept-charset="UTF-8"
                        class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari..."
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr  class="text-center">
                                        <th>Kegiatan</th>
                                        <th>Metode Pengadaan</th>
                                        <th>Jenis Pengadaan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subPerencanaan as $pp)
                                        <tr class="text-center">
                                            <td>{{ $pp->kegiatan }}</td>
                                            <td>
                                                {{ $pp->metodepengadaans ? $pp->metodepengadaans->nama_metode : '-' }}
                                            </td>
                                            <td>
                                                {{ $pp->jenispengadaans ? $pp->jenispengadaans->nama_jenis : '-' }}</td>
                                            <td>
                                                @if ($pp->pengadaan)
                                                    @php
                                                        $status = $pp->pengadaan->status->nama_status;
                                                        $statusClass = match ($status) {
                                                            'Pra dipa' => 'badge-secondary',
                                                            'Pemenuhan Dokumen' => 'badge-danger',
                                                            'Pemilihan Penyedia' => 'badge-primary',
                                                            'Kontrak' => 'badge-warning',
                                                            'Serah Terima' => 'badge-success',
                                                            default => 'badge-default',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $statusClass }}">
                                                        {{ $status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-default">
                                                        belum dalam periode
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <button
                                                    onclick="window.location.href='{{ url('/pp/show/' . $pp->id) }}'"
                                                    title="Detail" class="btn btn-info btn-sm mr-1">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </button>
                                                @if (isset($pp->pengadaan) &&
                                                        isset($pp->pengadaan->status) &&
                                                        !in_array($pp->pengadaan->status->nama_status, ['Pra dipa', 'Pemenuhan Dokumen', 'Kontrak', 'Serah Terima']))
                                                    <a href="{{ url('/pp/edit/' . $pp->id) }}" title="Edit"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {!! $subPerencanaan->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
