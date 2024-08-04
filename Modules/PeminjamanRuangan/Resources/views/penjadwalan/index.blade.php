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
                    <a href="{{ route('penjadwalan.create') }}" class="btn btn-primary btn-sm my-2"><i class="fas fa-plus"></i>
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
                                @if($data->count() > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->mataKuliah->kode }} - {{ $item->mataKuliah->nama }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->programStudi->nama }}</td>
                                            <td>{{ $item->pegawai->NIK }} - {{ $item->pegawai->nama }}</td>
                                            <td>{{ $item->hari }}</td>
                                            <td>{{ $item->jam_mulai }}</td>
                                            <td>{{ $item->jam_selesai }}</td>
                                            <td>{{ $item->ruang->kode_bmn }} - {{ $item->ruang->nama }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <a href="{{ route('penjadwalan.edit', $item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                                                    Edit</a>
                                                <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                    Hapus
                                                </button>
                                                <div class="modal fade" id="deleteModal{{ $item->id }}" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('penjadwalan.delete', $item->id) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Penjadwalan?</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Data yang dihapus tidak dapat dikembalikan, anda yakin ingin melanjutkan?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Ya, lanjutkan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center">Tidak ada data yang dapat ditampilkan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $paginate->onEachSide(2)->links('peminjamanruangan::paginate.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection
