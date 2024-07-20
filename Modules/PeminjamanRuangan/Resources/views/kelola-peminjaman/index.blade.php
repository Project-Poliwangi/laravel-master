@extends('adminlte::page')

@section('title', $title)
@section('content')
    <style>
        ::-webkit-scrollbar {
            /* width: 5px; */
            height: 10px;
            background: #e3e3e3;
        }
        
        ::-webkit-scrollbar-thumb {
            height: 5px;
            background: #c0c0c0;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <h4 style="font-weight: bold">{{ strtoupper($title) }}</h4>
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
                                    <input type="text" name="search" value="{{ $search }}" class="form-control ml-2" style="border-radius: 60px;">
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered small">
                            <thead class="thead-light">
                                <th style="white-space: nowrap;text-align: center">Kode Ruangan</th>
                                <th style="white-space: nowrap;text-align: center">Kode Prodi</th>
                                <th style="white-space: nowrap;text-align: center">Kode Mata Kuliah</th>
                                <th style="white-space: nowrap;text-align: center">Kode Dosen</th>
                                <th style="white-space: nowrap;text-align: center">Jadwal Mulai</th>
                                <th style="white-space: nowrap;text-align: center">Jadwal Selesai</th>
                                <th style="white-space: nowrap;text-align: center">NIM</th>
                                <th style="white-space: nowrap;text-align: center">Waktu Pinjam</th>
                                <th style="white-space: nowrap;text-align: center">Waktu Pengembalian</th>
                                <th style="white-space: nowrap;text-align: center">Keterangan</th>
                                <th style="white-space: nowrap;text-align: center">Gambar</th>
                                <th style="white-space: nowrap;text-align: center">Aksi</th>
                            </thead>
                            <tbody>
                                @if($data->count() > 0)
                                @foreach($data as $item)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $item->ruang->kode_bmn }}</td>
                                        <td style="white-space: nowrap;">{{ $item->programStudi->nama }}</td>
                                        <td style="white-space: nowrap;">{{ $item->mataKuliah->kode }}</td>
                                        <td style="white-space: nowrap;">{{ $item->pegawai->NIK }} - {{ $item->pegawai->nama }}</td>
                                        <td style="white-space: nowrap;">{{ $item->jadwal_mulai }}</td>
                                        <td style="white-space: nowrap;">{{ $item->jadwal_akhir }}</td>
                                        <td style="white-space: nowrap;">{{ $item->peminjam_nim }}</td>
                                        <td style="white-space: nowrap;">{{ $item->waktu_pinjam }} WIB</td>
                                        <td style="white-space: nowrap;">{{ $item->waktu_selesai }} WIB</td>
                                        <td style="white-space: nowrap;"></td>
                                        <td style="white-space: nowrap;"></td>
                                        <td style="white-space: nowrap;">
                                            <a href="" class="btn btn-success btn-sm small"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="" class="btn btn-warning btn-sm text-white"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center">Tidak ada data yang dapat ditampilkan</td>
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
