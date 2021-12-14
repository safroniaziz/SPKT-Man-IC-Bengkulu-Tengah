@extends('layouts.layout')
@section('menu')
    <li class="@if (Route::current()->getName() == "tu.dashboard") active @endif"><a href="{{ route('tu.dashboard') }}"><i class="fa fa-home"></i>&nbsp;Dashboard <span class="sr-only">(current)</span></a></li>
@endsection
@section('content')
    <div class="callout callout-info">
        <h4>Selamat Datang,  <b> </b></h4>

        <p>
            Anda Login Sebagai <b>Kepala Tata Usaha (KATU)</b> Pada Sistem Pelaporan Kegiatan Harian Tendik Oleh Pimpinan Madrasah Islam Negeri Insan Cendikia (MAN IC) Bengkulu Tengah
            <br>
            <i>Untuk keamanan, harap untuk <b>Logout</b> setelah menggunakan aplikasi !!</i>
        </p>
        
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title">Formulir Pelaporan Kegiatan Harian Tenaga Kependidikan (TENDIK)</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('tu.update') }}" method="POST">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="row">
                    <input type="hidden" name="kegId" 
                        @if (isset($_POST['kegId']))
                            value="{{ $data['detail']->kegId }}"
                        @endif
                    id="kegId">
                    <div class="col-md-12" id="peringatan" >
                        <div class="alert alert-warning" id="warning" style="margin-bottom:10px !important; display:none">
                            <b>Berhasil</b> : Data karyawan berhasil ditemukan, tetapi belum mengisi kegiatan hari ini
                        </div>
                        <div class="alert alert-success" id="success" style="margin-bottom:10px !important; display:none">
                            <b>Berhasil</b> : Data karyawan berhasil ditemukan, dan sudah mengisi kegiatan hari ini
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Berhasil :</strong>{{ $message }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="">Pilih Nama Pegawai Terlebih Dahulu  :</label>
                        <select name="pegNama" class="form-control" id="pegNama">
                            <option disabled selected>-- pilih pegawai --</option>
                            @foreach ($karyawans as $karyawan)
                                <option 
                                    @if (isset($_POST['kegId']))
                                    {{ $data['karyawan']->pegNip == $karyawan->pegNip ? 'selected' : '' }}
                                    @endif
                                value="{{ $karyawan->pegNip }}">{{ $karyawan->pegNama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Nomor Induk Pegawai (NIP) :</label>
                        <input type="text" disabled id="nip" @if (isset($_POST['kegId']))
                            value="{{ $data['karyawan']->pegNip }}"
                        @endif class="form-control">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="">Jabatan :</label>
                        <input type="text" disabled id="jabatan" @if (isset($_POST['kegId']))
                            value="{{ $data['karyawan']->pegNmJabatan }}"
                        @endif class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Tanggal :</label>
                        <input type="date" name="kegTgl" disabled id="tanggal" @if (isset($_POST['kegId']))
                            value="{{ $today }}"
                        @endif class="form-control">
                    </div>
                    <div class="loader d-none"></div>
                    
                    <div id="kegInput" >
                        <div class="form-group col-md-12">
                            <label for="">Kegiatan Tendik :</label>
                            <textarea name="kegTendik" id="kegTendik" class="form-control" readonly cols="30" rows="5">
                                @if (isset($_POST['kegId']))
                                    {{ $data['detail']->kegTendik }}
                                @endif
                            </textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Komentar Kepala Tata Usaha :</label>
                            <textarea name="komenTu" id="komenTu" class="form-control" cols="30" rows="10">
                                @if (isset($_POST['kegId']))
                                    {{ $data['detail']->kegSaranKatu }}
                                @endif
                            </textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Komentar Kepala Sekolah :</label>
                            <textarea name="komenKepsek" id="komenKepsek" readonly class="form-control" cols="30" rows="10">
                                @if (isset($_POST['kegId']))
                                    {{ $data['detail']->kegSaranKepsek }}
                                @endif
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center" id="btnSimpan">
                        <button type="submit" class="btn btn-primary btn-sm" 
                            @if (isset($_POST['kegId']))
                                @else
                                disabled
                            @endif
                        ><i class="fa fa-check-circle"></i>&nbsp; Simpan Komentar</button>
                        <button type="reset" class="btn btn-danger btn-sm" 
                            @if (isset($_POST['kegId']))
                                @else
                                disabled
                            @endif
                        ><i class="fa fa-close"></i>&nbsp; Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <script>
     

        CKEDITOR.replace( 'kegTendik' );
        CKEDITOR.replace( 'komenTu' );
        CKEDITOR.replace( 'komenKepsek' );

        CKEDITOR.config.allowedContent = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $(document).on('change','#pegNama',function(){
                // alert('berhasil');
                $('.loader').removeClass('d-none');
                var pegNama = $(this).val();
                var div = $(this).parent().parent();
                var op=" ";
                $.ajax({
                type :'get',
                url: "{{ route('kepala_sekolah.cari_detail_karyawan') }}",
                data: {'pegNama':pegNama,'_token':$('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        // alert('ketemu');
                        // alert(data['data']['id']);
                        $(':input[name="komenTu"]').prop('disabled', false)
                        $('#nip').val(data['karyawan']['pegNip']);
                        $('#jabatan').val(data['karyawan']['pegNmJabatan']);
                        $('#tanggal').val(data['today']);
                        CKEDITOR.instances['komenTu'].setReadOnly(false);
                        if (data['detail'] == null) {
                            $('#warning').show(300);
                            $('#success').hide(300);
                            $('#kegInput').hide(300);
                            $('#btnSimpan').hide(300);
                        } else{
                            $('#success').show(300);
                            $('#warning').hide(300);
                            $('#kegInput').show();
                            $('#btnSimpan').show();
                            $(':input[type="submit"]').prop('disabled', false)
                            $(':input[type="reset"]').prop('disabled', false)
                            $('#kegId').val(data['detail']['kegId']);
                            CKEDITOR.instances.kegTendik.setData( data['detail']['kegTendik'] );
                            CKEDITOR.instances.komenTu.setData( data['detail']['kegSaranKatu'] );
                            CKEDITOR.instances.komenKepsek.setData( data['detail']['kegSaranKepsek'] );
                            CKEDITOR.instances['kegTendik'].setReadOnly(true);
                            CKEDITOR.instances['komenTu'].setReadOnly(true);
                            CKEDITOR.instances['komenTu'].setReadOnly(false);
                        }
                        $('.loader').addClass('d-none');
                    },
                        error:function(){
                    }
                });
            })
        });
    </script>
@endpush