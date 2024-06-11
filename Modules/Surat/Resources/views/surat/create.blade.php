@extends('adminlte::page')
@section('title', 'Tambah Surat')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Tambah Surat</div>
                <div class="card-body">
                    
                    <a href="{{ url( (Request::server('HTTP_REFERER')==null?'/surat/surat-masuk':Request::server('HTTP_REFERER')) ) }}" title="Kembali"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
                    <br><br>
                    <form action="{{ url('surat/surat-masuk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Induk</label>
                                <input class="form-control" type="text" name="induk">
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Nomor Surat</label>
                                <input class="form-control" type="text" name="nomor">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Tanggal Surat</label>
                                <input class="form-control" type="date" name="tanggal_surat">
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Tanggal Diterima</label>
                                <input class="form-control" type="datetime-local" name="tanggal_diterima">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Pengirim</label>
                                <input class="form-control" type="text" name="pengirim">
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Diterima dari</label>
                                <input class="form-control" type="text" name="diterima_dari">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Perihal</label>
                            <textarea type="" name="perihal" id="" class="form-control"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="">Sifat</label>
                                <select name="sifat" class="form-control" id="">
                                    <option value="" selected disabled>--Pilih--</option>
                                    <option value="biasa">Biasa</option>
                                    <option value="segera">segera</option>
                                    <option value="penting">penting</option>
                                    <option value="penting segera">penting segera</option>
                                    <option value="rahasia">rahasia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="example-text-input">Pilih Tindakan</label>
                                <select id="status_surat" name="status" class="form-control">
                                    <option value="" selected disabled>--Pilih--</option>
                                    <option value="1">Arsipkan</option>
                                    <option value="2">Ajukan Ke Pimpinan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Catatan Sekretariat</label>
                            <textarea type="" name="catatan_sekretariat" id="" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="example-text-input" class="col-form-label">File</label>
                            <input class="form-control" type="file" name="file">
                        </div>
                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="example-text-input" class="col-form-label">Surat</label>
                                <input class="form-control" type="file" name="foto_surat">
                            </div>
                            <div class="col-md-6" id="lembar_disposisi" hidden>
                                <label for="example-text-input" class="col-form-label">Lembar Disposisi</label>
                                <input class="form-control" type="file" name="foto_disposisi">
                            </div>
                        </div> --}}
                        {{-- <div class="mb-3" id="tujuan" hidden>
                            <label for="">Tujuan Disposisi</label>
                            <select name="tujuan_disposisi" class="form-control" id="">
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="Direktur">Direktur</option>
                                <option value="Wadir I">Wakil Direktur I</option>
                                <option value="Wadir II">Wakil Direktur II</option>
                            </select>
                        </div> --}}
                        <div class="row mb-3 mt-3">
                            <div class="col-md-8 d-flex">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
