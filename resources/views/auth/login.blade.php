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
                    <form class="card" method="post" action="{{route('login')}}" onsubmit="return validCheck()">
                        @csrf
                        <input type="hidden" name="type" value="user">
                        <div class="card-body p-6">
                            <div class="card-title text-center">ユーザーログイン</div>
                            @error('email')
                            <div class="form-group">
                                <div class="error-form text-center p-2">
                                    <label class="error text-red">E-メールまたはパスワードが無効です。</label>
                                </div>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label class="form-label">メールアドレス</label>
                                <input type="email" name="email" class="form-control" id="email"  placeholder="メールアドレス">
                            </div>
                            <div class="form-group">
                                <label class="form-label">パスワード
                                    <a href="{{url('/password/reset')}}" class="float-right small">パスワードを忘れた方はこちら</a>
                                </label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="パスワード">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label class="custom-control custom-checkbox">--}}
{{--                                    <input type="checkbox" class="custom-control-input" />--}}
{{--                                    <span class="custom-control-label">Remember me</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                            </div>
                            <div class="text-center text-muted mt-3">
{{--                                <a href="{{url('/register')}}">新規登録</a>--}}
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

<!-- Theme JS files -->
<script src="{{ asset('js/custom.js') }}"></script>
<!-- /theme JS files -->
<script>
    function validCheck() {
        if($('#email').val()==""){
            $.growl.warning({
                title: "警告",
                message: "Eメールを入力してください。",
                duration: 3000
            });
            return false;
        }
        if($('#password').val()==""){
            $.growl.warning({
                title: "警告",
                message: "パスワードを入力してください。",
                duration: 3000
            });
            return false;
        }
        return true;
    }
</script>
</body>
