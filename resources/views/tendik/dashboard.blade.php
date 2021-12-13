@extends('layouts.layout')
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
        <h3 class="box-title">Formulir Pelaporan Kegiatan Harian Tenaga Kependidikan (TENDIK)</h3>
        </div>
        <div class="box-body">
            @if (empty($kegiatan))
            <form action="{{ route('tendik.post') }}" method="POST">
                {{ csrf_field() }} {{ method_field('POST') }}
            @else
            <form action="{{ route('tendik.update',[$kegiatan->kegId]) }}" method="POST">
                {{ csrf_field() }} {{ method_field('PATCH') }}
            @endif
                <div class="row">
                    <div class="col-md-12" id="peringatan" >
                        @if (empty($kegiatan))
                            <div class="alert alert-danger" style="margin-bottom:10px !important;">
                                Perhatian : Anda belum melaporkan kegiatan hari ini, silahkan inputkan kegiatan anda
                            </div>
                        @else
                            <div class="alert alert-success" style="margin-bottom:10px !important;">
                                Perhatian : Anda sudah melaporkan kegiatan hari ini, silahkan lakukan perubahan jika dibutuhkan
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Nomor Induk Pegawai (NIP) :</label>
                        <input type="text" disabled value="{{ Auth::user()->pegNip }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Nama Pegawai :</label>
                        <input type="text" disabled value="{{ Auth::user()->pegNama }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Jabatan :</label>
                        <input type="text" disabled value="{{ Auth::user()->pegNmJabatan }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Tanggal :</label>
                        <input type="date" name="kegTgl" disabled value="{{ $today }}" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-12" id="kegInput">
                        <label for="">Masukan Kegiatan :</label>
                        <textarea name="kegTendik" id="kegTendik" class="form-control" cols="30" rows="10">
                            @if (!empty($kegiatan))
                                {!! $kegiatan->kegTendik !!}
                            @endif
                        </textarea>
                    </div>

                    <div class="form-group col-md-12" id="kegInput">
                        <label for="">Komentar Kepala Tata Usaha :</label>
                        <textarea name="kegTendik" id="komenTu" disabled class="form-control" cols="30" rows="10">
                            @if (!empty($kegiatan))
                                {!! $kegiatan->kegSaranKatu !!}
                            @endif
                        </textarea>
                    </div>

                    <div class="form-group col-md-12" id="kegInput">
                        <label for="">Komentar Kepala Sekolah :</label>
                        <textarea name="kegTendik" id="komenKepsek" disabled class="form-control" cols="30" rows="10">
                            @if (!empty($kegiatan))
                                {!! $kegiatan->kegSaranKepsek !!}
                            @endif
                        </textarea>
                    </div>
                    <div class="col-md-12" style="text-align: center;" id="btnSimpan">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Simpan Kegiatan</button>
                        <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>&nbsp; Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

@push('scripts')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>

    CKEDITOR.replace( 'kegTendik' );
    CKEDITOR.replace( 'komenTu' );
    CKEDITOR.replace( 'komenKepsek' );

    CKEDITOR.config.allowedContent = true;
    </script>
@endpush