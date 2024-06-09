@extends('adminlte::page')
@section('title', 'Permohonan Diproses')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Daftar Permohonan Diproses</div>
                <div class="card-body">
                    <form method="GET" action="{{ url('/pengadaan/direktur') }}" accept-charset="UTF-8"
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
                                    <th>ID</th>
                                    <th>Kode</th>
                                    <th>Jenis Pengadaan</th>
                                    <th>Total</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>001-AB</td>
                                    <td>Barang dan Jasa</td>
                                    <td>200.000.000</td>
                                    <td>
                                        <a href="#" class="btn icon icon-left btn-secondary btn-sm"><i class="bi bi-eye"></i> Lihat</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">Diproses</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex">
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
