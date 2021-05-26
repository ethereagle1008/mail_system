@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        main {
            overflow-x: hidden;
        }
        #user, #ranking ul {
            padding-left: 2%;
            padding-right: 2%;
        }

        #user {
            background: #f3f3f3;
            font-size: 0.8em;
        }
        #user .inner {
            width: calc(100% - 0px - 5px);
            margin-right: 10px;
        }
        #user .inner .prof {
            border-bottom: 2px solid #fff;
            padding-bottom: 10px;
            position: relative;
            height: 4em;
            padding: 6% 0;
        }
        #user .inner > div p:first-child {
            margin-right: auto;
            font-size: .9em;
            margin-right: 10px;
            float: left;
            display: block;
        }

        #user .inner .prof_name {
            width: 42%;
        }
        #user span {
            font-weight: bold;
            font-size: 1.1em;
        }
        #user .inner .user_p {
            float: right;
        }
        #user .inner > div p:first-child {
            margin-right: auto;
            font-size: .9em;
            margin-right: 10px;
            float: left;
            display: block;
        }
        #user .id {
            display: inline-table;
        }

        #user span {
            font-weight: bold;
            font-size: 1.1em;
        }
        #user .inner > div p:last-child {
            width: 85px;
            font-size: 0.8em;
            float: right;
            display: block;
        }

        #user .inner > div p:nth-child(2) {
            padding-right: 7px;
            font-size: 0.8em;
            display: block;
        }
        #user .inner > div p:last-child a {
            color: #533d2a;
            border: 1px solid #533d2a;
        }

        #user .inner > div p:last-child a {
            border-radius: 3px;
            background: #fff;
            width: inherit;
            text-align: center;
            font-weight: bold;
            padding: 5px 0;
            font-size: 0.9em;
            line-height: 1.2em;
        }
        a {
            color: #333;
            text-decoration: none;
            display: block;
        }
        a {
            margin: 0;
            padding: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent;
        }
        .clear {
            clear: both;
        }
        #user .inner .point {
            padding-top: 10px;
            position: relative;
            height: 3.5em;
            padding: 15px 0;
        }
        #user .inner .point span {
            color: #fa5e3f;
        }
        h1.top {
            background: #2f1f11;
            background: -moz-linear-gradient(top, #785e47 0%, #2f1f11 100%);
            background: -webkit-linear-gradient(top, #785e47 0%,#2f1f11 100%);
            background: linear-gradient(to bottom, #785e47 0%,#2f1f11 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2f1f11', endColorstr='#533d2a',GradientType=0 );
        }

        h1 {
            color: #fff;
            font-weight: normal;
            line-height: 1;
            padding: 8px 0;
            font-size: 1em;
            font-weight: bold;
            text-align: center;
            position: relative;
        }
        h1:after {
            background: url(../img/texture.png);
        }

        h1:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
        }
        #archive > ul li {
            border-bottom: 1px solid #d1d1d1;
            position: relative;
        }

        li {
            list-style: none;
        }
        #archive.index > ul li > a {
            padding-left: 42px;
            height: 5em;
        }

        #archive > ul li a {
            color: #555;
            background: #efefef;
        }
        #archive > ul li > a {
            padding: 10px 2%;
        }
        .flex {
            display: -webkit-box;
            display: -moz-box;
            display: box;
            -moz-box-orient: horizontal;
            -webkit-box-orient: horizontal;
            flex-direction: row;
            -ms-flex-wrap: wrap;
            -moz-flex-wrap: wrap;
            -webkit-flex-wrap: wrap;
            flex-wrap: wrap;
            -moz-box-pack: justify;
            -ms-box-pack: justify;
            box-pack: justify;
            flex-pack: justify;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            /* justify-content: space-around; */
        }
        .thumb, #ranking > ul li a > span {
            width: 4em;
            height: 4em;
            overflow: hidden;
        }
        header li:first-child img, .thumb img, #ranking > ul li a > span img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        img {
            vertical-align: middle;
        }
        #archive > ul li a .contet {
            margin-left: 5px;
            font-size: 0.7em;
            /* position: absolute; */
            /* left: 115px; */
            right: 5px;
            width: 67%;
            line-height: 1.1;
        }
        #archive > ul li a h2 {
            display: table;
            width: 100%;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: #d3d3d3 1px dotted;
        }
        #archive > ul li a h2 p:first-child {
            width: 95%;
        }

        #archive > ul li a h2 p {
            display: block;
        }
        #archive > ul li a h2 p:last-child {
            text-align: right;
            font-weight: normal;
            color: #555;
            position: absolute;
            right: 2%;
            top: 10px;
            font-size: .5em;
        }
        ul{
            margin: 0 !important;
            padding: 0 !important;
        }
        h2 {
             font-size: 1.4rem;
        }

        #user, #ranking ul {
            padding-left: 2%;
            padding-right: 2%;
        }

        #ranking ul {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #ranking li {
            width: 33%;
        }

        #ranking li a {
            text-align: center;
            font-weight: bold;
            padding: 5px 0;
            font-size: 0.7em;
        }
        #ranking li:first-child a p {
            color: #907406;
        }

        #ranking li a p {
            height: 17px;
            line-height: 18px;
        }

        [class^="icon-"], [class*=" icon-"] {
            font-family: 'icomoon' !important;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /*.icon-crown:before {*/
        /*    content: "\e918";*/
        /*}*/
        #ranking li a span {
            font-size: 1.4em;
            margin: 0 2px;
        }
        .thumb, #ranking > ul li a > span {
            width: 4em;
            height: 4em;
            overflow: hidden;
        }

        #ranking li a > span {
            margin: 5px auto 10px;
            display: block;
        }
        #ranking .s_name {
            height: 1em;
        }
        #ranking li:nth-child(2) a p {
            color: #7c7c7c;
        }
        /*.icon-crown:before {*/
        /*    content: "\e918";*/
        /*}*/
        #ranking li:last-child a p {
            color: #a45f0e;
        }
        #s_btn {
            font-size: 1em;
            padding-bottom: 5px;
        }
        #s_btn a.sodan_btn {
            width: 92%;
            border: 1px solid #5b8c21;
            color: #5b8c21;
            border-radius: 3px;
            margin: 0 auto;
            background: #fff;
        }

        #ranking li a {
            text-align: center;
            font-weight: bold;
            padding: 5px 0;
            font-size: 0.7em;
        }
    </style>
@endsection

@section('content')
    <main>
        <div id="user" class="stretch wrap px-3">
            <div class="inner">
                <div class="prof center end wrap">
                    <p class="prof_name"><span>{{$name}}</span>様</p>
                    <div class="user_p">
                        <p>ID:<span class="id">{{$id}}</span></p>
                        <p><a href="{{url('/modify-profile')}}">プロフ編集</a></p>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="point center end wrap">
                    <p>保有ポイント</p>
                    <div class="user_p">
                        <p><span>{{$point}}</span>pt</p>
                        <p><a href="{{url('/point-list')}}">ポイント購入</a></p>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

        </div>


        <div id="archive" class="index">
            <h1 class="top mb-0">受信メール</h1>
            <ul>@if(count($mails) == 0)
                    <p class="m-3" style="color: red">受信ﾒｰﾙはありません。</p>
                @else
                    @foreach($mails as $mail)
                        <li><a href="{{url('/user-reply/'.$mail->q_id)}}" class="flex">
                                <div class="thumb"><img src="{{ $mail->image}}"></div>
                                <div class="contet">
                                    <h2><p style="font-size: .8em;">{{$mail->name}}</p>
                                        <p>{{$mail->receive_date}}</p></h2>
                                    <p class="line-clamp">
                                        {{$mail->content}}
                                    </p>

                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>

        </div>

        <div id="ranking" style="display: none">
            <h1 class="top">ランキング</h1>
            <ul class="flex mx-3">
                @foreach($characters as $index => $character)
                    <li>
                        <div id="">
                            <a href="{{url('/teacher-chat/'.$character->id)}}">
                                <p><i class="icon-crown"></i><span>{{$index+1}}</span>位</p>
                                <span><img src="{{ $character->image}}"></span>
                                <div class="s_name">{{$character->name}}</div>
                                <br>
                            </a>
                        </div>
                        <div id="s_btn">
                            <a href="{{url('/teacher-chat/'.$character->id)}}"
                               class="sodan_btn fsz12">相談する</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </main>
@endsection

@section('footer_top')
    <div class="card background-transparent position-sticky" style="bottom: 2rem;  margin-top: -140px">
        <div class="card-body background-opacity">
            <img src="{{asset('img/top.png')}}" class="img-top" id="move_garden" style="bottom: -.5rem">
            <img src="{{asset('img/up.png')}}" class="img-up" id="move_top" style="bottom: -.5rem">
        </div>
    </div>
@endsection

@section('footer_image')
    <img src="{{ asset('img/footer_1.png') }}" style="width: 100%">
@endsection

@section('js4event')
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
