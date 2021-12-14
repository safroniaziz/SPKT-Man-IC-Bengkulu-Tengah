@extends('layouts.layout')
@section('menu')
<li class="@if (Route::current()->getName() == "tendik.dashboard") active @endif"><a href="{{ route('tendik.dashboard') }}"><i class="fa fa-home"></i>&nbsp;Dashboard <span class="sr-only">(current)</span></a></li>
<li class="@if (Route::current()->getName() == "tendik.riwayat_kegiatan") active @endif"><a href="{{ route('tendik.riwayat_kegiatan') }}"><i class="fa fa-history"></i>&nbsp;Riwayat Kegiatan <span class="sr-only"></span></a></li>
@endsection
@section('content')
    <div class="callout callout-info">
        <h4>Selamat Datang,  <b> {{ Auth::user()->pegNama }}</b></h4>

        <p>
            Anda Login Sebagai <b>Tenaga Kependidikan (TENDIK)</b> Pada Sistem Pelaporan Kegiatan Harian Tendik Oleh Pimpinan Madrasah Islam Negeri Insan Cendikia (MAN IC) Bengkulu Tengah
            <br>
            <i>Untuk keamanan, harap untuk <b>Logout</b> setelah menggunakan aplikasi !!</i>
        </p>
        
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title">Riwayat Kegiatan Tenaga Kependidikan (Tendik)</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <form action="{{ route('tendik.cari_riwayat') }}" method="POST">
                    {{ csrf_field() }} {{ method_field('GET') }}
                    <div class="form-group col-md-6">
                        <label for="">Pilih Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Pilih Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Lihat Riwayat</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered"></table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
