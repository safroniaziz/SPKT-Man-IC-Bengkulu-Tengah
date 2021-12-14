<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

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


  
   
</body>
</html>