<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Slip Gaji</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('template/src/assets/images/logos/favicon.png')}}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
    @media print {
        @page {
            size: letter;
        }
    }

    body {
        width: 15cm;
        height: 28cm;
    }

    .row-kop-surat {
        border-bottom: solid 3px #000;
        position: relative;
    }
    .row-kop-surat::after {
        content: "";
        display: block;
        border-bottom: double 1px #000;
        position: absolute;
        left: 0;
        bottom: -6px;
        width: 100%;
    }
    #logoKopSurat {
        height: 0.8in;
        width: auto;
        margin-bottom: 10px;
    }
    .heading-kop-surat {
        font-size: 14pt;
        font-weight: bold;
    }
    h5 {
        font-weight: bold;
        text-underline-position: below;
        text-decoration: underline;
        font-size: 12pt;
    }
    p {
        font-size: 12pt;
        text-align: justify;
    }
    </style>
</head>
<body style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; background-color: white;">

    <div class="container-fluid border border-3 border-black p-4">
        <div class="row row-kop-surat">
            <h5 class="text-center mb-3 text-uppercase">SLIP Gaji</h5>
        </div>

        @php
            setlocale(LC_ALL, 'IND');

            function rupiah($angka){
                $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                return $hasil_rupiah;
            }
        @endphp

        <section class="container py-3">
            <table>
                <tr>
                    <td>Tanggal</td>
                    <td> :</td>
                    <td class="text-capitalize">
                        {{strftime('%A, %d %B %Y', strtotime(now()))}}
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{$slipGaji->nama_karyawan}}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>
                        {{$slipGaji->nama_jabatan}}
                    </td>
                </tr>
            </table>

            <div class="container px-2">
                <h6 class="mt-4 fw-bold">Rincian Gaji</h6>
                <table class="mt-3">
                    <tr class="d-flex">
                        <td style="width: 150px;">Gaji Pokok</td>
                        <td>:</td>
                        <td>{{rupiah($slipGaji->gaji_pokok)}}</td>
                    </tr>
                    <tr class="d-flex">
                        <td style="width: 150px;">Tunjangan</td>
                    </tr>

                    @foreach ($tunjangan as $item)
                    <tr class="d-flex">
                        <td style="width: 150px;">{{$item->nama_tunjangan}}</td>
                        <td>:</td>
                        <td>{{rupiah($item->jumlah_tunjangan)}}</td>
                    </tr>
                    @endforeach
                    
                    <tr class="d-flex fw-bold border-top border-black">
                        <td style="width: 150px;">Total Gaji</td>
                        <td>:</td>
                        <td>{{rupiah($totalGaji)}}</td>
                    </tr>
                </table>
            </div>
        </section>

    
        <div class="row">
            <div class="col-12">
    
                <div class="row mt-5">
                    <div class="col-7"></div>
                    <div class="col-5">
                        <p>
                            Diketahui, <br>
                        </p>
    
                        <br>
                        <br>
    
                        <p class="mb-0" style="text-decoration: underline; font-weight: bold;">Bendahara</p>
                        {{-- <p>NIP. 19800302 200604 1 005</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    {{-- <script>
        window.print();
    </script> --}}
</body>
</html>