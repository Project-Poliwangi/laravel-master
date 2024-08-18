<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak QR Code Ruangan</title>
    
    <style>
        @page {
            margin: .4in;
            margin-bottom: 0;
        }

        .page-break {
            page-break-before: always; /* Forces a page break before the element */
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 2.5rem;
            /* margin-bottom: 3rem; */
        }

        .flex-item {
            display: inline-block;
            width: 80%;
            padding: 1.5rem; /* Space between items */
            border: 1px solid;
            margin-left: 2.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="flex-container">
        @foreach ($ruangs as $key => $ruangan)
            <div class="flex-item" style="text-align: center;">
                <img src="{{ generateQrCode($ruangan->kode_qr) }}" width="400" alt="">
                <p style="padding: 0;margin-top: 8px;margin-bottom: 0">{{ $ruangan->nama }}</p>
            </div>

            @if(($key + 1) % 2 == 0)
                </div>
                <div class="page-break"></div>
                <div class="flex-container">
            @endif
        @endforeach
    </div>
</body>
</html>