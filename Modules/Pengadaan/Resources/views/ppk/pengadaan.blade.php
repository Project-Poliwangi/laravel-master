@extends('adminlte::page')
@section('title', 'Daftar Pengadaan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
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
                            {{-- <div class="row align-items-center">
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
                            </div> --}}
                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-4">
                            {{-- Form Searching --}}
                            <form method="GET" action="{{ url('/ppk/daftarpengadaan') }}" accept-charset="UTF-8"
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
                                    <th>Kegiatan</th>
                                    <th>Metode Pengadaan</th>
                                    <th>Jenis Pengadaan</th>
                                    <th>Status</th>
                                    <th colspan="3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subPerencanaan as $ppk)
                                    <tr class="text-center">
                                        <td>{{ $ppk->kegiatan }}</td>
                                        <td>{{ $ppk->metodepengadaans ? $ppk->metodepengadaans->nama_metode : '-' }}</td>
                                        <td>{{ $ppk->jenispengadaans ? $ppk->jenispengadaans->nama_jenis : '-' }}</td>
                                        <td>
                                            @if ($ppk->pengadaan && $ppk->pengadaan->status)
                                                @php
                                                    $status = $ppk->pengadaan->status->nama_status;
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
                                            <button class="btn btn-sm btn-primary ubah-status-btn" title="Status"
                                                onclick="showSelect({{ $ppk->id }})">
                                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                            </button>
                                            @if ($ppk->pengadaan)
                                                <form action="{{ route('ppk.updatestatus', $ppk->pengadaan->id) }}"
                                                    method="POST" id="form-{{ $ppk->id }}" style="display: none;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select class="form-control form-control-sm" id="status_id"
                                                        name="status_id" onchange="this.form.submit()">
                                                        @foreach ($statuses as $status)
                                                            <option value="{{ $status->id }}"
                                                                {{ isset($ppk->pengadaan) && $ppk->pengadaan->status_id == $status->id ? 'selected' : '' }}>
                                                                {{ $status->nama_status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @endif
                                            <div class="btn-group" role="group">
                                                <button onclick="window.location.href='{{ url('/ppk/show/' . $ppk->id) }}'"
                                                    title="Detail" class="btn btn-secondary btn-sm mr-1">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button onclick="window.location.href='{{ url('/ppk/edit/' . $ppk->id) }}'"
                                                    title="Edit" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $subPerencanaan->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('js')
    <script>
        function showSelect(id) {
            // Sembunyikan semua tombol ubah status dan semua form
            document.querySelectorAll('.ubah-status-btn').forEach(button => button.style.display = 'none');
            document.querySelectorAll('.btn-secondary').forEach(button => button.style.display = 'none');
            document.querySelectorAll('.btn-warning').forEach(button => button.style.display = 'none');
            document.querySelectorAll('form[id^="form-"]').forEach(form => form.style.display = 'none');

            // Tampilkan form yang sesuai
            var form = document.getElementById('form-' + id);
            if (form) {
                form.style.display = 'block';
            }
        }
    </script>
@endsection
