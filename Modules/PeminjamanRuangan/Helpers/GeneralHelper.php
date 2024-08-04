<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

if(!function_exists('generateQRCode')) {
    function generateQRCode($code) {
        $qrcode = QrCode::format('png')->merge(public_path('assets/img/logo.png'), 0.3, true)
                    ->size(300)->errorCorrection('H')
                    ->generate($code);

        return 'data:image/png;base64,'. base64_encode($qrcode);
    }
}

if(!function_exists('userInfo')) {
    function userInfo() {
        return auth()->user();
    }
}