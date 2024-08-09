@extends('adminlte::page')
@section('title', 'Daftar Pengadaan')
@section('content_header')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="m-0 text-dark">Daftar Pengadaan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Form untuk memilih jumlah item per halaman -->
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <p class="mb-0">Entries per page</p>
                                </div>
                                <div class="col-auto">
                                    <select name="per_page" id="per_page" class="form-control"
                                        onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-4">
                            {{-- Form Searching --}}
                            <form method="GET" action="{{ url('/unit') }}" accept-charset="UTF-8"
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
                        </div>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Akun Belanja</th>
                                    <th>Kegiatan</th>
                                    <th>Status</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subPerencanaan as $unit)
                                    <tr class="text-center">
                                        <td>{{ $unit->perencanaans->nama }}</td>
                                        <td>{{ $unit->kegiatan }}</td>
                                        <td>
                                            @if ($unit->pengadaan)
                                                @php
                                                    $status = $unit->pengadaan->status->nama_status;
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
                                            <div class="btn-group" role="group">
                                                <button
                                                    onclick="window.location.href='{{ url('/unit/show/' . $unit->id) }}'"
                                                    title="Detail" class="btn btn-info btn-sm mr-1">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </button>

                                                @if (isset($unit->pengadaan) &&
                                                        isset($unit->pengadaan->status) &&
                                                        !in_array($unit->pengadaan->status->nama_status, ['Pemilihan Penyedia', 'Kontrak', 'Serah Terima']))
                                                    <a href="{{ url('unit/edit/' . $unit->id) }}" title="Edit"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </div>
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
@stop

@section('css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stop
