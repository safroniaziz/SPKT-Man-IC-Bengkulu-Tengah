<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <title>SPKT MAN IC | Login</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
        <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href=" {{ asset('css/style_login.css') }} ">
        <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
	</head>
	<body>
		<div id="particles-js">
            <div class="loginBox">
                <img src=" {{ asset('assets/images/logo.png') }} " class="user">
                @if ($errors->any())
                    <div class="alert alert-danger alert-block" style="font-size:13px;">
                        <ul style="margin-bottom: 0px !important">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <h6>Form Login Tendik</h6>
                    <p style="text-align:center; margin-bottom:20px;">Sistem Pelaporan Kegiatan Harian<br> Tendik Oleh Pimpinan</p>
                @endif
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <p>Nomor Induk Kepegawaian</p>
                    <input type="text" value="{{ old('pegNip') }}" name="pegNip" placeholder="masukan nip">
                    <p>Password</p>
                    <input type="password" name="password" placeholder="••••••">
                    <button type="submit" name="submit" style="margin-bottom:10px;r"><i class="fa fa-sign-in"></i>&nbsp; Login</button>
                    <a href="{{ route('pimpinan.login') }}" style="font-weight:100; font-size:14px" ><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login Pimpinan</a>
                </form>
            </div>
        </div>
    </body>
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('assets/particles/particles.min.js') }} "></script>
    <script type="text/javascript" src=" {{ asset('assets/particles/app.js') }} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    {{-- <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script> --}}
    <script>
      
      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
            toastr.options = {"closeButton": true,"debug": false,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
            toastr.options = {"closeButton": true,"debug": false,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
            toastr.options = {"closeButton": true,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
            toastr.options = {"closeButton": true,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif
    </script>
</html>