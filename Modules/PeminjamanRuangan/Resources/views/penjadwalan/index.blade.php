@extends('adminlte::page')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row align-items-center">
                <div class="col-sm-6 col-12">
                    <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
                </div>
                <div class="col-sm-6 col-12 text-right">
                    <a href="{{ route('ruang.create') }}" class="btn btn-primary btn-sm my-2"><i class="fas fa-plus"></i>
                        Tambah Jadwal</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-12">
                                <div class="col-sm-12 col-6 mx-auto">
                                    <div class="d-flex align-items-center my-2 small">
                                        <div style="font-weight: bold">Show</div>
                                        <select name="show" class="form-control p-1 mx-2" onChange="this.form.submit()">
                                            <option value="10" {{ $show == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ $show == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ $show == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ $show == 100 ? 'selected' : '' }}>100</option>
                                        </select>
                                        <div style="font-weight: bold">entries</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto">
                                <div class="d-flex align-items-center my-2 small">
                                    <div style="font-weight: bold;white-space: nowrap">Search :</div>
                                    <input type="text" name="search" value="{{ $search }}"
                                        class="form-control ml-2" style="border-radius: 60px;">
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }} <button class="close"
                                data-dismiss="alert">&times;</button></div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered small">
                            <thead class="thead-light">
                                <th width="1%">No</th>
                                <th style="white-space: nowrap;text-align: center">Nama Mata Kuliah</th>
                                <th style="white-space: nowrap;text-align: center">SMT</th>
                                <th style="white-space: nowrap;text-align: center">Kelas</th>
                                <th style="white-space: nowrap;text-align: center">Prodi</th>
                                <th style="white-space: nowrap;text-align: center">Nama Dosen</th>
                                <th style="white-space: nowrap;text-align: center">Hari</th>
                                <th style="white-space: nowrap;text-align: center">Jam Mulai</th>
                                <th style="white-space: nowrap;text-align: center">Jam Selesai</th>
                                <th style="white-space: nowrap;text-align: center">Nama Ruangan</th>
                                <th style="white-space: nowrap;text-align: center">Keterangan</th>
                                <th style="white-space: nowrap;text-align: center">Aksi</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="12" class="text-center">Tidak ada data yang dapat ditampilkan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{ $paginate->onEachSide(2)->links('peminjamanruangan::paginate.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection
