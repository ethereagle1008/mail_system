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
    <!-- Core JS files -->
    <script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendors/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/vendors/selectize.min.js') }}"></script>
    <script src="{{ asset('js/vendors/jquery.tablesorter.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Fullside-menu Js-->
    <script src="{{ asset('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>

    <script src="{{ asset('plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- Custom scroll bar Js-->
    <script src="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- Theme JS files -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- /theme JS files -->

</head>
<body class="login-img">
<div id="global-loader" ></div>
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <a><img src="{{asset('img/SOKUAI.png')}}" class="h-6" alt=""></a>
                    </div>
                    <form class="card" method="post">
                        <div class="card-body p-6">
                            <div class="text-center card-title">パスワード確認</div>
                            <div class="form-group">
                                <label class="form-label" for="email">メールアドレス</label>
                                <input type="email" class="form-control" id="email"  placeholder="メールアドレス">
                            </div>
                            <div class="form-footer">
                                <button type="button" class="btn btn-primary btn-block" onclick="sendMail()">送信する</button>
                            </div>
                            <div class="text-center text-muted mt-3 ">
                                <a href="{{url('/login')}}">ログインページに戻る</a>
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
<script src="{{ asset('js/vendors/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/vendors/selectize.min.js') }}"></script>
<script src="{{ asset('js/vendors/jquery.tablesorter.min.js') }}"></script>
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
    function sendMail() {
        let path = '{{url('/password/email')}}';
        let _token = '{{csrf_token()}}'
        let email = $('#email').val()
        $("#global-loader").fadeIn("slow");
        $.post(path,{_token:_token,email:email},function (resp) {
            $("#global-loader").fadeOut("slow");
            if(resp.result){
                if(resp.email_exist){
                    $.growl.notice({
                        title: "成功",
                        message: "メールは正常に送信されました。",
                        duration: 3000
                    });
                }else{
                    $.growl.warning({
                        title: "警告",
                        message: "メールは存在しません。",
                        duration: 3000
                    });
                }
            }
            else{
                $.growl.warning({
                    title: "警告",
                    message: "サーバーエラー",
                    duration: 3000
                });
            }
        })
    }
</script>
</body>
