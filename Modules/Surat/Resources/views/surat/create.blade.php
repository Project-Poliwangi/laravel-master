@extends('adminlte::page')
@section('title', 'Tambah Surat')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Tambah Pegawai</div>
                <div class="card-body">
                    <form action="{{ url('surat/surat-masuk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Nomor Surat</label>
                                <input class="form-control" type="text" name="no_surat">
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Nama Pengirim</label>
                                <input class="form-control" type="text" name="pengirim">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Perihal</label>
                            <textarea type="" name="perihal" id="" class="form-control"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Tanggal Surat</label>
                                <input class="form-control" type="date" name="tanggal_surat">
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Status Surat</label>
                                <select id="status_surat" name="status" class="form-control">
                                    <option value="" selected disabled>--Pilih--</option>
                                    <option value="1">Perlu Disposisi</option>
                                    <option value="2">Arsipkan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Surat</label>
                                <input class="form-control" type="file" name="foto_surat">
                            </div>
                            <div class="col-md-6" id="lembar_disposisi" hidden>
                                <label for="example-text-input" class="col-form-label">Lembar Disposisi</label>
                                <input class="form-control" type="file" name="foto_disposisi">
                            </div>
                        </div>
                        <div class="mb-3" id="tujuan" hidden>
                            <label for="">Tujuan Disposisi</label>
                            <select name="tujuan_disposisi" class="form-control" id="">
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="Direktur">Direktur</option>
                                <option value="Wadir I">Wakil Direktur I</option>
                                <option value="Wadir II">Wakil Direktur II</option>
                            </select>
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="col-md-8 d-flex">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                {{-- <div class="col-md-2" id="kirim" hidden>
                                    <button type="button" class="btn btn-primary">Kirim</button>
                                </div> --}}
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-dark">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('status_surat').addEventListener('change', function() {
            var statusSurat = this.value;
            var lembarDisposisi = document.getElementById('lembar_disposisi');
            var tujuan = document.getElementById('tujuan');
            // var kirim = document.getElementById('kirim');
            if (statusSurat == '1') {
                lembarDisposisi.removeAttribute('hidden');
                tujuan.removeAttribute('hidden');
                // kirim.removeAttribute('hidden');
            } else if (statusSurat == '2') {
                lembarDisposisi.setAttribute('hidden', 'hidden');
                tujuan.setAttribute('hidden', 'hidden');
                // kirim.setAttribute('hidden', 'hidden');
            }
        });
    </script>
@endsection
