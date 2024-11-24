<!DOCTYPE html>
<!-- saved from url=(0028)https://pap.kalsel.site/auth -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIPAPAN</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
         <link href="https://pap.kalsel.site/assets/foto_profil/sipapan.ico" rel="shortcut icon">
       <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/login/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Theme style -->
        <link rel="stylesheet" href="/login/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/login/blue.css">
            <!-- Animate.css -->
    <link href="/gentella/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="./SIPAPAN login_files/css">
 <style>.login-page{background-image:url("assets/foto_profil/greenlaptop.jpg")!important;background-repeat:no-repeat;background-attachment:fixed;background-position:center;background-size:cover}.login-box-body{background:rgba(255,255,255,.8)!important}</style>
   </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">

              @php
                    $messagewarning = Session::get('warning');
                @endphp
                @if (Session::get('warning'))
                <a class="login-box-msg"><i class="fa fa-times text-danger"></i> <strong>Login Gagal ! </strong>{{ $messagewarning }}</a>
                <br>
                @endif
                        <div class="login-logo">
                <img src="/login/logo.png" width="160" height="160">
            </div>

            <p class="login-box-msg">Silahkan Login Terlebih Dahulu untuk Masuk ke Aplikasi</p>

                <!--<form action="https://pap.kalsel.site//adminlte/index2.html" method="post">-->
                <form action="/proses_login_wp" method="post" accept-charset="utf-8">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <span class="glyphicon gly fa fa-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon gly fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat"><i class="f/logindden="true"></i> Login</button>
                    </div>
                <!--    <div class="col-xs-6">
                        <a href="https://pap.kalsel.site/#" class="btn btn-primary btn-block btn-flat"><i class="fa fa-eye-slash" aria-hidden="true"></i> Lupa Password</a>
                    </div>-->
                </div>
                <!-- /.col -->

                </form>




            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <!-- jQuery 3 -->
        <script src="/login/jquery.min.js.download"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="/login/bootstrap.min.js.download"></script>
        <!-- iCheck -->
        <script src="/login/icheck.min.js.download"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>


</body></html>
