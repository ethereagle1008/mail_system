<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_csrf" content="{{csrf_token()}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_csrf_header" content="_token"/>
    <meta name="format-detection" content="telephone=no">

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/alertify.min.js' )}}"></script>
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161447215-30"></script> -->


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="icon" href="{{ asset('favicon.jpg') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Top.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nicepage.css') }}">

{{--    <link rel="stylesheet" href="{{ asset('css/default2.css') }}" media="all" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/common_site2.css') }}" media="all" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/color2.css') }}" media="all" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/font.css?170530') }}?">--}}
    <link rel="stylesheet" href="{{ asset('css/icon.css') }}">


    <style>

        .btn-search {
            font-size: 1rem;
            font-weight: 800;
            background-color: #EA617C;
            {{--background-image: url("{{asset('img/top-search.png')}}");--}}
             border: 0px;
            background-repeat: round;
            color: white;
            padding: .6rem .4rem;
            border-radius: .5rem;
        }

        .box-shadow-none {
            box-shadow: none;
        }


        @font-face {
            font-family: YugoBold;
            src: url('{{ asset('fonts/YuGothic-Bold.otf') }}') format('opentype');
        }

        @font-face {
            font-family: YugoMedium;
            src: url('{{ asset('fonts/YuGothic-Medium.otf') }}') format('opentype');
        }

        @font-face {
            font-family: KosugiMaru;
            src: url('{{ asset('fonts/KosugiMaru-Regular.ttf') }}') format('truetype');
        }

        .txt-family-kosugi {
            font-family: KosugiMaru !important;
        }

        .nav-bar-custom {
            position: absolute;
            top: 100%;
            right: 0;
            background: #EFFAFB;
            width: 79%;
        }

        .scrollable {
            max-height: calc(100vh - 90px);
            overflow-y: scroll;
        }

        [name=move_list] {
            cursor: pointer !important
        }

        .star {
            cursor: pointer !important;
        }

        .help {
            cursor: pointer !important;
        }

        .more_detail {
            cursor: pointer !important;
        }

        .top-title-tag {
            cursor: pointer !important;
        }

        #previous {
            cursor: pointer !important;
        }

        #next {
            cursor: pointer !important;
        }

        .unread-count{
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            width:30px;
            height: 30px;
            line-height: 30px;
        }


    </style>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Fonts -->

    @yield('css4page')

</head>
<body>

<div class="container" style="max-width: 750px; padding: 0px; position: relative">

    <header class="position-sticky w-100 background-white" id="top_header" style="z-index: 1100;">
        <p class="top-title text-small-xs pb-0" id="top_title" style="display:none;">
            @yield('title')
        </p>
        @yield('nav')
    </header>

    <main>
        @yield('content')
    </main>


    <footer class="u-align-center-sm u-align-center-xs u-clearfix u-footer u-grey-80 u-footer" id="sec-9bc6">

        <div
            class="navbar-question u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-border-1 u-border-grey-40 u-container-style u-group u-group-1">
            <div class="u-container-layout u-valign-middle u-container-layout-1">
                <h1 class="u-align-center u-text u-text-2 cursor-pointer">お問い合わせ</h1>
            </div>
        </div>
        <div
            class="navbar- u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-border-1 u-border-grey-40 u-container-style u-group u-group-2">
            <div class="u-container-layout u-valign-middle u-container-layout-2">
                <h1 class="u-align-center u-text u-text-3 cursor-pointer"></h1>
            </div>
        </div>
{{--        <div--}}
{{--            class="navbar-point u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-border-1 u-border-grey-40 u-container-style u-group u-group-3">--}}
{{--            <div class="u-container-layout u-valign-middle u-container-layout-3">--}}
{{--                <h1 class="u-align-center u-text u-text-4 cursor-pointer">ポイント購入画面</h1>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div
            class="navbar-guide1 u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-border-1 u-border-grey-40 u-container-style u-group u-group-4">
            <div class="u-container-layout u-valign-middle u-container-layout-4">
                <h1 class="u-align-center u-text u-text-5 cursor-pointer"></h1>
            </div>
        </div>

        <p class="u-text u-text-8">©RENAI SOUDAN</p>
    </footer>
    @yield('footer_top')


</div>


@yield('modal')
<input type="hidden" id="home_path" value="<?=url('/');?>">


<script>
    $(document).ready(function () {
        var home_path = $("#home_path").val();
        $(".navbar-menu").click(function(event) {
            //$("#navbarSupportedContent-4").toggle();
            if($(this)[0].getAttribute('aria-expanded')){
                $("#navbarSupportedContent-4").toggle('hide');
            }
            if($(this).find('.icon-menu').hasClass('d-none')){
                $(this).find('.icon-menu').removeClass('d-none')
                $(this).find('.x-icon').addClass('d-none')
                $("#move_top").removeClass("d-none");
            }
            else{
                $(this).find('.x-icon').removeClass('d-none')
                $(this).find('.icon-menu').addClass('d-none')
                $("#move_top").addClass("d-none");
            }
        });

        $(".navbar-login").click(function(event) {
            window.location.href = home_path + '/login';
        });

        $(".navbar-logout").click(function(event) {
            var url = home_path + '/logout';
            $.ajax({
                url:url,
                type:'get',
                data: {
                },
                success: function (response) {
                    alertify.success("成功ログアウト");
                    //window.location.reload();
                    window.location.href = home_path + '/';
                },
                error: function () {
                }
            });
        });

        $(".title-logo").click(function(event) {
            window.location.href = home_path+ '/my-page';
        });
        $(".navbar-rank").click(function(event) {
            window.location.href = home_path + '/teacher-rank';
        });
        $(".navbar-guide").click(function(event) {
            window.location.href = home_path + '/terms';
        });
        $(".navbar-question").click(function(event) {
            window.location.href = home_path + '/question';
        });
        $(".navbar-my").click(function(event) {
            window.location.href = home_path + '/my-page';
        });
        $(".navbar-admin").click(function(event) {
            window.location.href = home_path + '/manage/home';
        });
        $(".navbar-mail").click(function(event) {
            window.location.href = home_path + '/mail-list';
        });
        $(".navbar-point").click(function(event) {
            window.location.href = home_path + '/point-list';
        });
        $(".navbar-logout").click(function(event) {
            var url = home_path + '/logout';
            var token = $("meta[name='_csrf']").attr("content");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url:url,
                type:'post',
                data: {
                },
                success: function (response) {
                    //alertify.success("成功ログアウト");
                    //window.location.reload();
                    window.location.href = home_path + '/login';
                },
                error: function () {
                }
            });
        });
        $(".title-kodomore").click(function () {
            window.location.href = home_path;
        })
        $("#move_garden").click(function(event) {
            window.location.href = home_path + '/my-page';
        });
        $("#move_top").click(function() {
            window.scrollTo(0, 0);
        });
        $("#move_top").addClass("d-none");

        window.addEventListener("scroll", function(event) {
            var top = this.scrollY,
                left =this.scrollX;
            if(top <= 0) {
                $("#move_top").addClass("d-none");
                $("#top_title").removeClass("d-none");

                $("nav").addClass("box-shadow-none");

            } else {
                $("#move_top").removeClass("d-none");
                $("nav").removeClass("box-shadow-none");
                $("#top_title").addClass("d-none");
            }
        }, false);
    });

</script>
@yield('js4event')
</body>
</html>
