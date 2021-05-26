<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#0061da">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MailSystem') }}</title>

    <!-- Font Family-->
    <link rel="stylesheet" href="{{ asset('fonts/fonts/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">

    <link href="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
</head>
<body class="login-img">
<div id="global-loader" ></div>
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <form class="card" method="post">
                        <div class="card-body p-6">
                        <div class="card-title text-center">Verify your email</div>
                        <div class="form-group">
                            <label class="form-label">Code</label>
                            <input type="text" id="code" name="code" class="form-control" placeholder="Enter code">
                        </div>
                        <div class="form-footer">
                            <button id="btn_submit" type="button" class="btn btn-primary btn-block" onclick="checkCode()">Confirm</button>
                        </div>
                        <div class="text-center text-muted mt-4">
                            Don't you get an email? <a href="javascript:void(0);" id="resend_code" onclick="resendCode()">Resend code</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Core JS files -->
<script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/vendors/bootstrap.bundle.min.js') }}"></script>
<!-- /core JS files -->

<!-- Custom scroll bar Js-->
<script src="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Notifications js -->
<script src="{{ asset('plugins/notify/js/rainbow.js') }}"></script>
<script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>

<!-- Theme JS files -->
<script src="{{ asset('js/custom.js') }}"></script>
<!-- /theme JS files -->
<script>
    function checkCode() {
        let formData = new FormData();
        let _token = '{{csrf_token()}}';
        let path = '{{route('email.check_code')}}'
        let code = $('#code').val();
        formData.append('code',code);
        formData.append('_token',_token);
        $.ajax({
            url: path,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.result){
                    if(response.success)
                        location.href = "/home"
                    else{
                        $.growl.warning({
                            title: "Error",
                            message: "Code is not valid",
                            duration: 3000
                        });
                    }
                }
            },
        });
    }

    function resendCode() {
        $("#global-loader").fadeIn("slow");
        let formData = new FormData();
        let _token = '{{csrf_token()}}';
        let path = '{{route('email.resend')}}'
        formData.append('_token',_token);
        $.ajax({
            url: path,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                $("#global-loader").fadeOut("slow");
                if(response.result){
                    $.growl.notice({
                        title: "Success",
                        message: "We sent an email again."
                    });
                }else{
                    $.growl.warning({
                        title: "Warning",
                        message: "Server Error",
                        duration: 3000
                    });
                }
            },
        });
    }
</script>
</body>

