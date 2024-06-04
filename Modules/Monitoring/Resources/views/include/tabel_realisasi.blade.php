{{-- tabel rekapitulasi --}}
<div class="col-lg-12">
    <div class="btn-group" role="group" aria-label="Table toggles">
        <button type="button" class="btn btn-primary" id="btn-table-1">Realisasi</button>
        <button type="button" class="btn btn-outline-primary" id="btn-table-2">Revisi dan Kendala</button>
    </div>

    <div id="table-1" class="table-responsive">
        <div class="card">
            <div class="card-header">Data Realisasi</div>
            <div class="card-body">
                <a href="{{ url('/kepegawaian/pegawai/create') }}" class="btn btn-success btn-sm"
                    title="Tambah Pegawai">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </a>

                <form method="GET" action="{{ url('/kepegawaian/pegawai') }}" accept-charset="UTF-8"
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
                            <tr>
                                <th>#</th>
                                <th>kode</th>
                                <th>Nama Program Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perencanaans as $perencanaan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $perencanaan->kode }}</td>
                                <td>{{ $perencanaan->nama }}</td>
                                <td>
                                    <a href="{{ route('realisasi.sub_index', $perencanaan->id) }}"
                                        title="View Realisasi">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="{{ url('/realisasi/' . $perencanaan->id . '/edit') }}"
                                        title="Edit Realisasi">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit" arria-hidden="true"></i>
                                        </button>
                                    </a>

                                    <form method="POST" action="{{ url('/realisasi/' . $perencanaan->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Realisasi"
                                            onclick="return confirm(&quot;Confirm delete?&quot;)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                        {!! $perencanaans->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="table-2" class="table-responsive" style="display: none;">
        <div class="card">
            <div class="card-header">Revisi dan kendala</div>
            <div class="card-body">
                <a href="{{ url('/kepegawaian/pegawai/create') }}" class="btn btn-success btn-sm"
                    title="Tambah Pegawai">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                </a>

                <form method="GET" action="{{ url('/kepegawaian/pegawai') }}" accept-charset="UTF-8"
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
                            <tr>
                                <th>Bulan</th>
                                <th>Unit</th>
                                <th>Kendala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>cek</td>
                                <td>cek</td>
                                <td>cek</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex">
                        {!! $perencanaans->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const table1 = document.getElementById('table-1');
        const table2 = document.getElementById('table-2');
        const btnTable1 = document.getElementById('btn-table-1');
        const btnTable2 = document.getElementById('btn-table-2');

        btnTable1.addEventListener('click', () => {
            table1.style.display = 'block';
            table2.style.display = 'none';
            btnTable1.classList.add('btn-primary');
            btnTable1.classList.remove('btn-outline-primary');
            btnTable2.classList.add('btn-outline-primary');
            btnTable2.classList.remove('btn-primary');
        });

        btnTable2.addEventListener('click', () => {
            table1.style.display = 'none';
            table2.style.display = 'block';
            btnTable1.classList.add('btn-outline-primary');
            btnTable1.classList.remove('btn-primary');
            btnTable2.classList.add('btn-primary');
            btnTable2.classList.remove('btn-outline-primary');
        });
    });

</script>
@endpush
