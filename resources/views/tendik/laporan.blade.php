<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<title>Cetak Riwayat Kegiatan Tendik</title>
	<link href="{{ asset('css/pdf.css') }}" rel="stylesheet" type="text/css" media="screen" title="Default">
	<link href="{{ asset('css/pdf_cetak.css') }}" rel="stylesheet" type="text/css" media="print" title="Default">
	<style type="text/css">
		@page { size 8.5in 11.69; margin: 2cm;}
		div.page { page-break-after: always }
		table{font-family: Times; text-align: justify;}
		.MsoTableGrid{width: 100%}
		@media screen {
		  div.divFooter {
		    position: fixed;
		    bottom: 0;
		  }
		}
		@media print {
		  div.divFooter {
		    position: fixed;
		    bottom: 0;
		  }
		}
		#pengesah{
			font-size: 14pt;
		}
		.tb {
          border: 1px solid black;border-collapse: collapse;padding: 7px;
        }

        table tr td{
            font-size: 18px;
        }
	</style>

</head>
<body data-gr-c-s-loaded="true" onload="window.print()">
	<div class="page" style="margin-bottom: 150px">
		<div id="container">
		   <div class="nobreak">
				<div id="header" style="margin-bottom: 2px;">
					<div id="logo_unib" style="">
						<img style="width: 110px; height: auto;" src="{{ asset('assets/images/logo.png') }}">
					</div>
					<div id="judul_unib">
						<div style="font-size:20px">KEMENTERIAN AGAMA REPUBLIK INDONESIA</b></div>
						<div style="font-size:20px">MADRASAH ALIYAH NEGERI INSAN CENDIKIA BENGKULU TENGAH</div>
						<div style="font-size:18px">Jl. Insan Cendikia Renah Lebar Kecamatan Karang Tinggi</div>
						<div style="font-size:18px">Kabupaten Bengkulu Tengah Provinsi Bengkulu 38382</div>
						<div style="font-size:18px">Email : admin@manicbenteng.sch.id</div>
					</div>
				</div>
                <div style="margin-top: 5px;">
					<hr style="height: 2px;">
                </div>

				<div id="" style="font-family: Times;margin-top:50px;margin-bottom: 50px;font-size:14pt;font-weight: bold;text-align: center;">
					LAPORAN KEGIATAN HARIAN TENDIK <br>
					{{ $model['tanggal_awal'] }} s/d {{ $model['tanggal_akhir'] }}
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
                <table class="table table-bordered table-hover" id="data" style="width: 100% !important; border-collapse: collapse; width: 100%; " >
                    <thead>
                        <tr>
                            <th style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">No</th>
                            <th style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">Hari / Tanggal</th>
                            <th style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">Kegiatan Tendik</th>
                            <th style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">Catatan Kepala Tata Usaha</th>
                            <th style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">Catatan Kepala Madrasah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">{{ $no++ }}</td>
                                <td style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">{{ $laporan->kegTgl }}</td>    
                                <td style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">{!! $laporan->kegTendik !!}</td>    
                                <td style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">{!! $laporan->kegSaranKatu !!}</td>    
                                <td style="padding: 8px !important;text-align: left !important;border-bottom: 1px solid #ddd !important;">{!! $laporan->kegSaranKepsek !!}</td>    
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                
			</div>
            <div id="table_right" style="margin-top: 50px;">
                <div id="pengesah">
                    <table>
                        <tbody>
                            Bengkulu, {{ $today }}<br><br><br><br>
                            {{ Auth::user()->pegNama }}<br>
                            {{ Auth::user()->pegNip }}?>
                        </tbody>
                    </table>
                 </div>
            </div>
		</div>
	</div>
</body>
</html>