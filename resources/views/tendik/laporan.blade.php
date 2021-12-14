<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Cetak Kegiatan Tendik</title>
</head>
<style>
    .img-top {
        opacity: 0.6;
    }
    #header tr td {
        border: none !important;
        border-collapse: collapse;
    }

    .page-break {
        page-break-after: always;
    }

    .sit-in-the-corner {
        float: left;
        margin-left: 5px;
        margin-top: -85px;
    }

    .logo-koperasi {
        text-align: center;
    }
</style>
<body>
    <table id="header" cellspacing="0" cellpadding="0" style="width:100%" class="top">
        <tr >
            <td rowspan="5" style="width: 5% !important;" class="logo-koperasi"><img src="{{ asset('assets/images/logo.png') }}" style="width: 75px !important"></td>
            <td style="width:95% !important;" align="center"><b>KEMENTERIAN AGAMA REPUBLIK INDONESIA</b></td>
        </tr>
        <tr style="width: 100%">
            <td colspan="3" style="text-align: center;"><b>MADRASAH ALIYAH NEGERI INSAN CENDIKIA BENGKULU TENGAH</b></td>
        </tr>
        <tr style="width: 100%">
            <td colspan="3" style="text-align: center;">Jl. Insan Cendikia Renah Lebar Kecamatan Karang Tinggi</td>
        </tr>
        <tr style="width: 100%">
            <td colspan="3" style="text-align: center;">Kabupaten Bengkulu Tengah Provinsi Bengkulu 38382</td>
        </tr>
        <tr style="width: 100%">
            <td colspan="3" style="text-align: center;">Email : admin@manicbenteng.sch.id</td>
        </tr>
    </table>
    <hr style="height: 1px; background:black;">
    <div style="text-align: center">
        <h5>LAPORAN KEGIATAN HARIAN TENDIK</h5>
        {{ $model['tanggal_awal'] }} - {{ $model['tanggal_akhir'] }}
    </div>

    <table>
        <tr>
            <td style="width: 20% !important">Nama</td>
            <td>:</td>
            <td>
                {{ Auth::user()->pegNama }}
            </td>
        </tr>

        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>
                {{ Auth::user()->pegTpLhr }}/{{ Auth::user()->pegTglLhr }}
            </td>
        </tr>

        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>
                {{ Auth::user()->pegNmJabatan }}
            </td>
        </tr>

        <tr>
            <td>No.Hp</td>
            <td>:</td>
            <td>
                {{ Auth::user()->pegNoHp }}
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table class="table table-bordered table-hover" id="data" style="width: 100% !important; ">
        <thead>
            <tr style="border:2px black solid">
                <th>No</th>
                <th>Hari / Tanggal</th>
                <th>Kegiatan Tendik</th>
                <th>Catatan Kepala Tata Usaha</th>
                <th>Catatan Kepala Madrasah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no=1;
            @endphp
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $laporan->kegTgl }}</td>    
                    <td>{!! $laporan->kegTendik !!}</td>    
                    <td>{!! $laporan->kegSaranKatu !!}</td>    
                    <td>{!! $laporan->kegSaranKepsek !!}</td>    
                </tr>
            @endforeach
        </tbody>
    </table>
  
   
</body>
</html>