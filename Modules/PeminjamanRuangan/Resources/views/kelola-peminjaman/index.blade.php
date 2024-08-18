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
                                        <option value="10" {{ $show==10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ $show==25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ $show==50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ $show==100 ? 'selected' : '' }}>100</option>
                                    </select>
                                    <div style="font-weight: bold">entries</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <div class="d-flex align-items-center my-2 small">
                                <div style="font-weight: bold;white-space: nowrap">Search :</div>
                                <input type="text" name="search" value="{{ $search }}" class="form-control ml-2"
                                    style="border-radius: 60px;">
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
                    <table class="table small">
                        <thead class="thead-light">
                            <th width="1%">No.</th>
                            <th style="white-space: nowrap;text-align: center">Kode Ruangan</th>
                            <th style="white-space: nowrap;text-align: center">NIM</th>
                            {{-- <th style="white-space: nowrap;text-align: center">Kode Prodi</th>
                            <th style="white-space: nowrap;text-align: center">Kode Mata Kuliah</th>
                            <th style="white-space: nowrap;text-align: center">Kode Dosen</th> --}}
                            <th style="white-space: nowrap;text-align: center">Jadwal Mulai</th>
                            <th style="white-space: nowrap;text-align: center">Jadwal Selesai</th>
                            <th style="white-space: nowrap;text-align: center">Status</th>
                            {{-- <th style="white-space: nowrap;text-align: center">Waktu Pinjam</th> --}}
                            {{-- <th style="white-space: nowrap;text-align: center">Waktu Pengembalian</th>
                            <th style="white-space: nowrap;text-align: center">Keterangan</th>
                            <th style="white-space: nowrap;text-align: center">Gambar</th> --}}
                            <th style="white-space: nowrap;text-align: center" width="150">Aksi</th>
                        </thead>
                        <tbody>
                            @if($data->count() > 0)
                            @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="white-space: nowrap;">{{ $item->ruang->kode_bmn }} - {{ $item->ruang->nama }}
                                </td>
                                {{-- <td style="white-space: nowrap;">{{ $item->programStudi->nama }}</td>
                                <td style="white-space: nowrap;">{{ $item->mataKuliah->kode }}</td>
                                <td style="white-space: nowrap;">{{ $item->pegawai->NIK }} - {{ $item->pegawai->nama }}
                                </td> --}}
                                <td style="white-space: nowrap;">{{ $item->peminjam_nim }}</td>
                                <td style="white-space: nowrap;">{{ $item->jadwal_mulai }}, {{ $item->waktu_pinjam }}
                                    WIB</td>
                                <td style="white-space: nowrap;">{{ $item->jadwal_akhir }}, {{ $item->waktu_selesai }}
                                    WIB</td>
                                <td>
                                    @if($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @elseif($item->status == 'reject')
                                    <span class="badge badge-danger">Ditolak</span>
                                    @else
                                    <span class="badge badge-success">Diterima</span>
                                    @endif
                                </td>
                                {{-- <td style="white-space: nowrap;">{{ $item->waktu_pinjam }} WIB</td>
                                <td style="white-space: nowrap;">{{ $item->waktu_selesai }} WIB</td>
                                <td style="white-space: nowrap;"></td>
                                <td style="white-space: nowrap;"></td> --}}
                                <td style="white-space: nowrap;text-align: center">
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                        data-target="#myModal{{ $item->id }}"><i class="fas fa-eye"></i> Detail</button>
                                    <div class="modal fade" id="myModal{{ $item->id }}" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-weight: bold">Detail</h5>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Kode Ruangan</th>
                                                            <td>:</td>
                                                            {{-- <td class="text-center"> --}}
                                                                {{-- <img src="{{ generateQrCode($item->ruang->kode_qr) }}"
                                                                    width="150" alt=""> --}}
                                                                {{-- <div class="block text-center mt-2"> --}}
                                                            <td>
                                                                {{ $item->ruang->kode_bmn }} - {{ $item->ruang->nama }}
                                                            </td>
                                                                {{-- </div>
                                                            </td> --}}
                                                        </tr>
                                                        <tr>
                                                            <th>status</th>
                                                            <td>:</td>
                                                            <td>
                                                                @if($item->status == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                                @elseif($item->status == 'reject')
                                                                <span class="badge badge-danger">Ditolak</span>
                                                                @else
                                                                <span class="badge badge-success">Diterima</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Program Studi</th>
                                                            <td>:</td>
                                                            <td>{{ $item->programStudi->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kode Matakuliah Studi</th>
                                                            <td>:</td>
                                                            <td>{{ $item->mataKuliah->kode }} - {{
                                                                $item->mataKuliah->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dosen Pengampu</th>
                                                            <td>:</td>
                                                            <td>{{ $item->pegawai->NIK }} - {{ $item->pegawai->nama }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIM Peminjam</th>
                                                            <td>:</td>
                                                            <td>{{ $item->peminjam_nim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jadwal</th>
                                                            <td>:</td>
                                                            <td>{{ $item->jadwal_mulai }} - {{ $item->jadwal_akhir }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jam</th>
                                                            <td>:</td>
                                                            <td>{{ $item->waktu_pinjam }} - {{ $item->waktu_selesai }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Close</button>
                                                    @if($item->status == 'pending')
                                                    <a href="{{ route('kelola-peminjaman.edit', $item->id) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    <a href="{{ route('kelola-peminjaman.reject', $item->id) }}"
                                                        class="btn btn-danger"><i class="fas fa-times"></i>
                                                        Tolak</a>
                                                    <a href="{{ route('kelola-peminjaman.accept', $item->id) }}"
                                                        class="btn btn-success"><i class="fas fa-check-circle"></i>
                                                        Terima</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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