@extends('adminlte::page')
@section('title', 'Edit Formulir')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-10 col-md-10 order-md-1 order-last">
                <div class="card-header bg-dark">
                    <h5 class="text-center">Formulir Edit Pengadaan</h5>
                </div>

                <form id="unit-edit" method="POST" action="{{ url('unit/update/' . $subPerencanaan->id) }}" accept-charset="UTF-8"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include ('pengadaan::unit.form', [
                        'formMode' => $formMode,
                        'pengadaan' => $pengadaan,
                        'subPerencanaan' => $subPerencanaan,
                    ])
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('unit-edit').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengubah data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
@endpush