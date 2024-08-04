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
                    <table class="table table-bordered small">
                        <thead class="thead-light">
                            <th style="white-space: nowrap;text-align: center" width="1%">No.</th>
                            <th style="white-space: nowrap;text-align: center">Kode Ruangan</th>
                            {{-- <th style="white-space: nowrap;text-align: center">Kode Program Studi</th>
                            <th style="white-space: nowrap;text-align: center">Kode Mata Kuliah</th>
                            <th style="white-space: nowrap;text-align: center">Kode Dosen Pengampu</th> --}}
                            <th style="white-space: nowrap;text-align: center">NIM</th>
                            <th style="white-space: nowrap;text-align: center">Jadwal Mulai</th>
                            <th style="white-space: nowrap;text-align: center">Jadwal Selesai</th>
                            {{-- <th style="white-space: nowrap;text-align: center">Waktu Mulai</th>
                            <th style="white-space: nowrap;text-align: center">Waktu Selesai</th> --}}
                            <th style="white-space: nowrap;text-align: center">Keterangan</th>
                            {{-- <th style="white-space: nowrap;text-align: center">Gambar</th> --}}
                            <th style="white-space: nowrap;text-align: center" width="150">Aksi</th>
                        </thead>
                        <tbody>
                            @if ($data->count() > 0)
                            @foreach ($data as $item)
                            <tr>
                                <td style="white-space:nowrap">{{ $loop->iteration }}</td>
                                <td style="white-space:nowrap">{{ $item->ruang->kode_bmn }} - {{ $item->ruang->nama }}
                                </td>
                                <td style="white-space:nowrap">{{ $item->peminjam_nim }}</td>
                                <td style="white-space:nowrap">{{ $item->jadwal_mulai }}</td>
                                <td style="white-space:nowrap">{{ $item->jadwal_akhir }}</td>
                                <td style="white-space:nowrap">
                                    <span
                                        class="badge py-1 px-2 {{ $item->status == 'pending' ? 'bg-warning' : ($item->status == 'approve' ? 'bg-success' : 'bg-danger') }}">{{
                                        ucfirst($item->status) }}</span>
                                </td>
                                <td style="white-space:nowrap" width="150">
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                        data-target="#myModal{{ $item->id }}"><i class="fas fa-eye"></i></button>
                                    @if($item->status == 'pending')
                                    <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#deleteModal{{ $item->id }}"><i
                                            class="fas fa-trash-alt"></i></button>
                                    @endif

                                    <div class="modal fade" id="deleteModal{{ $item->id }}" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('peminjaman.delete', $item->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Permohonan?</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Data yang dihapus tidak dapat dikembalikan, anda yakin ingin
                                                            melanjutkan?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Ya,
                                                            lanjutkan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="myModal{{ $item->id }}" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-weight: bold">Detail</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Kode Ruangan</th>
                                                            <td>:</td>
                                                            <td class="text-center">
                                                                <img src="{{ generateQrCode($item->ruang->kode_qr) }}"
                                                                    width="150" alt="">
                                                                <div class="block text-center mt-2">{{
                                                                    $item->ruang->kode_bmn }} - {{ $item->ruang->nama }}
                                                                </div>
                                                            </td>
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
                                                    <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-success"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    @endif
                                                    {{-- <button class="btn btn-warning btn-sm text-white"
                                                        data-toggle="modal" data-dismiss="modal"
                                                        data-target="#deleteModal{{ $item->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                        Hapus
                                                    </button>
                                                    <div class="modal fade" id="deleteModal{{ $item->id }}"
                                                        role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form
                                                                    action="{{ route('peminjaman.delete', $item->id) }}"
                                                                    method="post">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delete Permohonan?</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Data yang dihapus tidak dapat dikembalikan,
                                                                            anda yakin ingin melanjutkan?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Ya,
                                                                            lanjutkan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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