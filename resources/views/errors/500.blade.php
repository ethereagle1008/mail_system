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

    <link href="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
</head>
<body class="login-img">
<div id="global-loader" ></div>
<div class="page ">
    <div class="page-content">
        <div class="container text-center">
            <div class="display-1 text-primary mb-5">500</div>
            <h1 class="h2  mb-3">ページが見つかりません</h1>
            <p class="h4 font-weight-normal mb-7 leading-normal ">おっと！！！使用できないページにアクセスしようとしました。ホームに戻ってください。</p>
            <a class="btn btn-primary" href="{{url('/')}}">
                ホームに戻って
            </a>
        </div>
    </div>
</div>

<!-- Core JS files -->
<script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/vendors/bootstrap.bundle.min.js') }}"></script>
<!-- /core JS files -->

<!-- Custom scroll bar Js-->
<script src="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Theme JS files -->
<script src="{{ asset('js/custom.js') }}"></script>
<!-- /theme JS files -->

</body>

