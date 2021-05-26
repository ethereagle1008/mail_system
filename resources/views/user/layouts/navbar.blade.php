<!--Navbar -->
<?php
    if(!empty(session()->get(SESS_UID))){
        $message_count = \App\Question::where('user_id',session()->get(SESS_UID))->where('receive_date', '<', date('Y-m-d H:i:s'))->where('status','unread')->where('type','character_sent')->count();
    }else{
        $message_count = 0;
    }
?>
<nav class="navbar box-shadow-none pr-2">
    <a class="navbar-brand p-0" style="margin-right: 8px; display: flex"><img class="title-logo img-kodo-height" style="width: auto !important;" src="<?=asset('img/SOKUAI.png');?>"></a>

    @if(!empty(session()->get(SESS_UID)) || !empty(session()->get(SESS_ADMIN_UID)))
        <div style="width: 56px;">
        </div>
    @else
        <div class="navbar-toggler text-black text-center ml-3 navbar-login" >
            <img src="{{asset('img/login-account.png')}}" style="margin-left: 0;">
            <p class="text-menu mt-1">アカウント</p>
        </div>
    @endif

    <div class="navbar-toggler text-center text-black ml-1 navbar-menu" data-toggle="collapse" data-target="#navbarSupportedContent-4"
         aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation" style="">
        <img class="icon-menu " src="{{asset('img/menu-navbar.png')}}" >
        <img class="d-none x-icon " src="{{asset('img/x-icon-menu.png')}}" >
        <p class="text-menu mt-1">メニュー</p>
    </div>

    <div class="collapse navbar-collapse nav-bar-custom p-3 z-depth-5 scrollable" id="navbarSupportedContent-4" style="display: none !important; z-index: 1050;">
        <ul class="navbar-nav ml-auto">
            <div class="form-group">
                @if(!empty(session()->get(SESS_UID)))
                    <div class="text-black text-center my-1 ml-1 navbar-logout d-flex pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">
                        <img class="mr-2 img-icon height-half"  src="{{asset('img/small_logout.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">ログアウト</p>
                    </div>

                    <div class="text-black text-center ml-1 d-flex navbar-my pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">
                        <img class="mr-2 img-icon height-half" style="" src="{{asset('img/person-icon-nav.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">マイページ</p>
                    </div>
                    <div class="text-black text-center ml-1 d-flex navbar-mail pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333;position: relative">
                        <img class="mr-2 img-icon height-half" style="" src="{{asset('img/mail.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">メール受信ボックス</p>
                        @if($message_count>0)
                        <div class="unread-count">{{$message_count}}</div>
                        @endif
                    </div>
{{--                    <div class="text-black text-center ml-1 d-flex navbar-point pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">--}}
{{--                        <img class="mr-2 img-icon height-half" style="" src="{{asset('img/cart.png')}}">--}}
{{--                        <p class="text-medium-xs my-1 cursor-pointer">ポイント購入画面</p>--}}
{{--                    </div>--}}
{{--                    <div class="text-black text-center ml-1 d-flex navbar-rank pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">--}}
{{--                        <img class="mr-2 img-icon height-half" style="" src="{{asset('img/top-three.png')}}">--}}
{{--                        <p class="text-medium-xs my-1 cursor-pointer">先生ランキング</p>--}}
{{--                    </div>--}}
                @elseif(!empty(session()->get(SESS_ADMIN_UID)))
                    <div class="text-black text-center my-1 ml-1 navbar-logout d-flex pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">
                        <img class="mr-2 img-icon height-half"  src="{{asset('img/small_logout.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">ログアウト</p>
                    </div>

                    <div class="text-black text-center ml-1 d-flex navbar-admin pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">
                        <img class="mr-2 img-icon height-half" style="" src="{{asset('img/person-icon-nav.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">マイページ</p>
                    </div>
                @else
                    <div class="text-black text-center my-1 ml-1 navbar-login d-flex pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">
                        <img class="mr-2 img-icon height-half"  src="{{asset('img/small_login.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">ログイン･新規会員登録</p>
                    </div>
                    <div class="text-black text-center ml-1 d-flex navbar-rank pl-1 pb-1 mb-3" style="border-bottom: 1px solid #333333">
                        <img class="mr-2 img-icon height-half" style="" src="{{asset('img/top-three.png')}}">
                        <p class="text-medium-xs my-1 cursor-pointer">ランキング</p>
                    </div>
                @endif

{{--                <div class="text-black text-center ml-1 navbar-guide d-flex pb-1 mb-3 px-4 mt-5" style="border-bottom: 1px solid #333333">--}}
{{--                    <p class="text-small cursor-pointer">利用規約</p>--}}
{{--                </div>--}}
                <div class="text-black text-center ml-1 navbar-question d-flex pb-1 mb-3 px-4" style="border-bottom: 1px solid #333333">
                    <p class="text-small cursor-pointer">お問合わせ</p>
                </div>
            </div>
        </ul>
    </div>


</nav>
<!--/.Navbar -->
