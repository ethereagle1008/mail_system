@php

if(isset($_GET['ad'])){
    $ad_code = isset($_GET['ad'])?$_GET['ad']:'';
\App\AdAccessTime::create([
            'ad_code' => $ad_code,
            'access_time' => date('Y-m-d H:i:s'),
            'type' => 'access'
        ]);
}else{
    $ad_code = "";
}

@endphp
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

    <!-- Date Picker Plugin -->
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
</head>
<body class="login-img">
<div id="global-loader" ></div>
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="text-center mb-6">
                        <a><img src="{{asset('img/SOKUAI.png')}}" class="h-6" alt=""></a>
                    </div>
                    <form class="card" method="post" action="{{route('register')}}" onsubmit="return validCheck()" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-6">
                            <div class="card-title text-center">新規登録</div>
                            @error('email')
                            <div class="form-group">
                                <div class="text-center">
                                    <label class="error text-red">Email is in use.</label>
                                </div>
                            </div>
                            @enderror
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ID</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="名称">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">メールアドレス</label>
                                                <input type="text" id="email" class="form-control" placeholder="メールアドレス">
                                                <input type="hidden" name="email" class="form-control">
                                            </div>
                                        </div>
{{--                                        <div class="col-5 pl-0">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label">@</label>--}}
{{--                                                <select class="form-control" name="email_type">--}}
{{--                                                    <option value="@docomo.ne.jp">@docomo.ne.jp</option>--}}
{{--                                                    <option value="@au.com">@au.com</option>--}}
{{--                                                    <option value="@softbank.ne.jp">@softbank.ne.jp</option>--}}
{{--                                                    <option value="@ezweb.ne.jp">@ezweb.ne.jp</option>--}}
{{--                                                    <option value="@t.vodafone.ne.jp">@t.vodafone.ne.jp</option>--}}
{{--                                                    <option value="@k.vodafone.ne.jp">@k.vodafone.ne.jp</option>--}}
{{--                                                    <option value="@d.vodafone.ne.jp">@d.vodafone.ne.jp</option>--}}
{{--                                                    <option value="@h.vodafone.ne.jp">@h.vodafone.ne.jp</option>--}}
{{--                                                    <option value="@c.vodafone.ne.jp">@c.vodafone.ne.jp</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">性別</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="0">男</option>
                                            <option value="1">女</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">生年月日</label>
                                        <input type="text" id="birth" name="birth" class="form-control fc-datepicker" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">既婚・未婚</label>
                                        <select class="form-control" name="marry" id="">
                                            <option value="0">未婚</option>
                                            <option value="1">既婚</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">お住まいの地域</label>
                                        <select class="form-control" name="region" id="region">
                                            <option value="0">地域を選択してください</option>
                                            @foreach($regions as $one)
                                                <option value="{{$one->name}}">{{$one->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">パスワード</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="パスワード">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">パスワード確認</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="パスワード確認">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">プロファイル画像</label>
                                        <div class="preview" style="margin: 20px;">
                                            <img id="photo-preview" src="" alt="no_img" class="" style=" width: 100px">
                                            <button id="img_del" class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                                        </div>
                                        {{--                                    <div class="d-flex" id="profile_img">--}}
                                        {{--                                        <img class="" src="{{asset('img/org.jpg')}}">--}}
                                        {{--                                    </div>--}}
                                        <button type="button" id="img_add" class="" onclick="openFile()" style="">写真を添付</button>
                                        <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="agree" class="custom-control-input" />
                                            <span class="custom-control-label"><a>利用約款</a>に同意します。</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 offset-md-4">
                                    <div class="form-footer" style="margin-top: 1rem">
                                        <button id="btn_submit" type="submit" class="btn btn-primary btn-block" disabled>新規登録</button>
                                    </div>
                                    <div class="text-center text-muted mt-4">
                                        <a href="{{url('/login')}}">ログイン</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="ad_code" value="{{$ad_code}}">
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

<!-- Datepicker js -->
<script src="{{ asset('plugins/date-picker/spectrum.js') }}"></script>
<script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>

<!-- Theme JS files -->
<script src="{{ asset('js/custom.js') }}"></script>
<!-- /theme JS files -->
<script>
    $('.preview').hide();
    $('#agree').on('change',function () {
        if($(this).prop("checked") == true)
            $('#btn_submit').prop('disabled',false);
        else
            $('#btn_submit').prop('disabled',true);
    })
    function openFile() {
        $('#photo').trigger('click');
    }
    $("#photo").on("change", function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo-preview').attr('src', e.target.result);
                $('.preview').show();
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
    function deleteImg() {
        $('.preview').hide();
        $('#photo-preview').attr('src',"");
        $('#photo').val('');
    }
    function validCheck() {
        if($('#name').val()==""){
            $.growl.warning({
                title: "警告",
                message: "名前を入力してください。",
                duration: 3000
            });
            return false;
        }
        if($('#email').val()==""){
            $.growl.warning({
                title: "警告",
                message: "メールアドレスを入力してください。",
                duration: 3000
            });
            return false;
        }
        else{
            //$('[name=email]').val($('#email').val() + $('[name=email_type]').val());
            $('[name=email]').val($('#email').val());
        }
        if($('#password').val()==""){
            $.growl.warning({
                title: "警告",
                message: "パスワードを入力してください。",
                duration: 3000
            });
            return false;
        }
        if($('#password').val().length<6){
            $.growl.warning({
                title: "警告",
                message: "パスワードは6文字以上にする必要があります。",
                duration: 3000
            });
            return false;
        }
        if($('#password').val()!=$('#password_confirmation').val()){
            $.growl.warning({
                title: "警告",
                message: "パスワードを確認してください。",
                duration: 3000
            });
            return false;
        }
        return true;
    }
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'yy-mm-dd'
    });
</script>
</body>
