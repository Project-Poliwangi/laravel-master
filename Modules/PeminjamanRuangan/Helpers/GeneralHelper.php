<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

if(!function_exists('generateQRCode')) {
    function generateQRCode($code) {
        $qrcode = QrCode::format('png')->merge(public_path('assets/img/logo.png'), 0.2, true)
                    ->size(300)->errorCorrection('H')
                    ->generate($code);

        return $qrcode;
    }
}