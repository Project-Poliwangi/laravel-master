@extends('adminlte::page')
@section('title', 'Daftar Pengadaan')
@section('content_header')
    <h1 class="m-0 text-dark">
    </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Daftar Pengadaan</div>
                <div class="card-body">
                    <form method="GET" action="{{ url('/direktur') }}" accept-charset="UTF-8"
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
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Kegiatan</th>
                                    <th>Jenis Pengadaan</th>
                                    <th>Unit</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengadaans as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->subperencanaan ? $item->subperencanaan->kegiatan : '-' }}</td>
                                        <td>
                                            {{ $item->subperencanaan ? $item->subperencanaan->jenispengadaans->nama_jenis : '-' }}
                                        </td>
                                        <td>
                                            {{ $item->subperencanaan ? $item->subperencanaan->unit->nama : '-' }}
                                        </td>
                                        <td>
                                            @if ($item->status)
                                                @php
                                                    $status = $item->status->nama_status;
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
                                        <td>
                                            <button onclick="window.location.href='{{ url('/direktur/show/' .  $item->subperencanaan->id) }}'"
                                                title="Detail" class="btn btn-secondary btn-sm mr-1">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <!-- Font Awesome -->
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
