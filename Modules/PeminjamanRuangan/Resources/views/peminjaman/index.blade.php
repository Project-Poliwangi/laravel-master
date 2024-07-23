@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row align-items-center">
                <div class="col-sm-6 col-12">
                    <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
                </div>
                {{-- <div class="col-sm-6 col-12 text-right">
                    <a href="{{ route('ruang.create') }}" class="btn btn-primary btn-sm my-2"><i class="fas fa-plus"></i>
                        Tambah Ruangan</a>
                </div> --}}
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
                                <th style="white-space: nowrap;text-align: center" width="1%">No.</th>
                                <th style="white-space: nowrap;text-align: center">Kode Ruangan</th>
                                <th style="white-space: nowrap;text-align: center">Kode Program Studi</th>
                                <th style="white-space: nowrap;text-align: center">Kode Mata Kuliah</th>
                                <th style="white-space: nowrap;text-align: center">Kode Dosen Pengampu</th>
                                <th style="white-space: nowrap;text-align: center">Jadwal Mulai</th>
                                <th style="white-space: nowrap;text-align: center">Jadwal Selesai</th>
                                <th style="white-space: nowrap;text-align: center">NIM</th>
                                <th style="white-space: nowrap;text-align: center">Waktu Mulai</th>
                                <th style="white-space: nowrap;text-align: center">Waktu Selesai</th>
                                <th style="white-space: nowrap;text-align: center">Keterangan</th>
                                <th style="white-space: nowrap;text-align: center">Gambar</th>
                                <th style="white-space: nowrap;text-align: center" width="150">Aksi</th>
                            </thead>
                            <tbody>
                                @if ($data->count() > 0)
                                    @foreach ($data as $item)
                                        <td style="white-space:nowrap">{{ $loop->iteration }}</td>
                                        <td style="white-space:nowrap">{{ $item->ruang->kode_bmn }} - {{ $item->ruang->nama }}</td>
                                        <td style="white-space:nowrap">{{ $item->programStudi->nama }}</td>
                                        <td style="white-space:nowrap">{{ $item->mataKuliah->kode }} - {{ $item->mataKuliah->nama }}</td>
                                        <td style="white-space:nowrap">{{ $item->pegawai->NIK }} - {{ $item->pegawai->nama }}</td>
                                        <td style="white-space:nowrap">{{ $item->jadwal_mulai }}</td>
                                        <td style="white-space:nowrap">{{ $item->jadwal_akhir }}</td>
                                        <td style="white-space:nowrap">{{ $item->NIM }}</td>
                                        <td style="white-space:nowrap">{{ $item->waktu_pinjam }}</td>
                                        <td style="white-space:nowrap">{{ $item->waktu_selesai }}</td>
                                        <td style="white-space:nowrap">{{ $item->status }}</td>
                                        <td style="white-space:nowrap">{{ $item->foto_selesai }}</td>
                                        <td style="white-space:nowrap" width="150">
                                            <button class="btn btn-success"><i class="fas fa-edit"></i> Edit</button>
                                            <button class="btn btn-warning"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data yang dapat ditampilkan</td>
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
