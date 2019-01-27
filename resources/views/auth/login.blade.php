<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amazon Stocks</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/solid.css" integrity="sha384-+0VIRx+yz1WBcCTXBkVQYIBVNEFH1eP6Zknm16roZCyeNg2maWEpk/l/KsyFKs7G" crossorigin="anonymous">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css"> --}}

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<style>
    body{
        /* background: url('img/mountain.png') no-repeat center center fixed;
        background-size: cover; */
        background: #46A941;
    }
    .modal-dialog {
    min-height: calc(100vh - 80px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: auto;
}
@media(max-width: 768px) {
  .modal-dialog {
    min-height: calc(100vh - 40px);
  }
}
    .main-section{
        margin:0 auto;
        margin-top:60px;
        padding: 0;
    }
    .modal-content{
        background-color: #004B1B;
        opacity: .8;
        padding: 0 18px;
        border-radius: 10px;
    }
    .user-img img{
        height: 120px;
        width: 120px;
    }
    .user-img{
        margin-top: -60px;
        margin-bottom: 45px;
    }
    .form-group{
        margin-bottom: 25px;
    }
    .form-group input{
        height: 42px;
        border-radius: 5px;
        border: 0px;
        font-size: 18px;
        letter-spacing: 2px;
        padding-left: 54px;
    }
    .form-group::before{
        font-family: 'Font Awesome\ 5 Free';
        content: "\f007";
        position: absolute;
        font-size: 22px;
        left: 28px;
        padding-top: 4px;
        color:#202020;
    }
    .form-group:last-of-type::before{
        content: "\f023";
    }
    .form-input button{
        width: 40%;
        margin: 5px 0 25px;
    }
    .btn-success{
        background-color: #FDB813;
        font-size: 19px;
        border-radius: 5px;
        padding: 7px 14px;
        border: 1px solid #FDB813;
        color: #202020;
    }
    .btn-success:hover{
        background-color: #FDB813;
        border: 1px solid #FDB813;
    }
</style>
{{-- <body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>Amazon </b>Stocks</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
        <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
</div> --}}

<body>


    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="col-sm-9 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="/img/logo.png" alt="logo" class="img-circle ">
                </div>
                <div class="col-12 form-input">
                    <form method="post" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
            
                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="ชื่อผู้ใช้">
                            
                            @if ($errors->has('username'))
                                <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
            
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password">
                            
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
            
                        </div>
                        <button type="submit" class="btn btn-success ">เข้าใช้งาน</button>
                        {{-- <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.login-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
