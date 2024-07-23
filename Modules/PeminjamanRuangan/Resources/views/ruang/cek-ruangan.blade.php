@extends('peminjamanruangan::layouts.master')

@section('title', $title)
@section('css')
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <style>
        #preview {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-sm-12 col-12">
            <h4 style="font-weight: bold" class="my-2">{{ strtoupper($title) }}</h4>
        </div>
        <div class="col-md-5 col-sm-8 col-12 mx-auto">
            @error('kode')
                <div class="alert alert-danger">{{ $message }}. <button class="close" data-dismiss="alert">&times;</button></div>
            @enderror
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="text-center mb-3">Scan QR Code</h5>
                    <video id="preview" class="border"></video>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Inisialisasi Instascan
        let video = document.getElementById('preview')
        video.style.height = video.offsetWidth +'px'
        let scanner = new Instascan.Scanner({
            video: video
        });

        // Menangkap hasil pemindaian
        scanner.addListener('scan', function(content) {
            window.location.assign(`${location.href}/${content}`)

            // Hentikan pemindaian setelah QR code ditemukan
            scanner.stop();
        });

        // Memulai pemindaian saat video siap
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('Tidak ada kamera yang ditemukan.');
            }
        }).catch(function(e) {
            console.error(e);
        });
    </script>
@endsection
