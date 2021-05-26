@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        h1.cap {
            background: #2f1f11;
            background: -moz-linear-gradient(top, #785e47 0%, #2f1f11 100%);
            background: -webkit-linear-gradient(top, #785e47 0%, #2f1f11 100%);
            background: linear-gradient(to bottom, #785e47 0%, #2f1f11 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2f1f11', endColorstr='#533d2a', GradientType=0);
        }

        h1.cap {
            border-radius: 0px;
            padding: 6px 0;
            font-size: 1.5em;
            font-weight: bold;
            width: 100%;
            display: table;
            line-height: 1;
            color: #fff;
            position: relative;
            text-align: center;
        }

        #teller_profile h1 span.name {
            display: table-cell;
            vertical-align: middle;
            line-height: 1.3;
        }

        #teller_profile h1 span.genre {
            color: #fff;
        }

        #teller_profile h1 span.genre {
            font-weight: bold;
            text-align: left;
            font-family: "Times New Roman", "游明朝", YuMincho, "Hiragino Mincho ProN", Meiryo, serif;
        }

        h1:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(../img/texture.png);
            opacity: 0.1;
        }

        #teller_profile div.description {
            float: right;
            width: 45%;
            margin: 0px 0px 10px 15px;
        }

        #teller_profile div.description figure {
            text-align: center;
        }

        #teller_profile div.description figure img, ul.tellerlist_contents li figure img, div.favo_teller figure img {
            border: 2px solid #533d2a;
        }

        #teller_profile div.description figure img {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        img {
            vertical-align: middle;
        }

        a:link, a:active, a:visited {
            outline: none;
            text-decoration: none;
        }

        a {
            margin: 0;
            padding: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent;
        }

        p {
            color: #564f4e;
            line-height: 135%;
            letter-spacing: -0.01em;
            text-align: justify;
            text-justify: distribute-all-lines;
        }

        a.btn_short, .btn_short {
            width: 38%;
            height: 40px;
            line-height: 37px;
        }
        a.btn_base, .btn_base {
            display: block;
            box-sizing: border-box;
            -moz-border-radius: 0.3em;
            -webkit-border-radius: 0.3em;
            border-radius: 0.3em;
            text-align: center;
            text-decoration: none;
            font-size: 1.3em;
            font-weight: bold;
            margin: 0 auto;
        }

        a.forward_siteclr, .forward_siteclr {
            background: #5179f1;
            background: -moz-linear-gradient(top, #5179f1 0%, #5179f1 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#5179f1), color-stop(100%,#5179f1));
            background: -webkit-linear-gradient(top, #5179f1 0%,#5179f1 100%);
            border: 1px solid #5179f1;
            color: #ffffff;
            text-shadow: 1px 1px 1px #223b87;
            margin: 15px auto;
            -moz-border-radius: 0.5em;
            -webkit-border-radius: 0.5em;
            border-radius: 0.5em;
            position: relative;
        }

        a.btn_base, .btn_base {
            display: block;
            box-sizing: border-box;
            -moz-border-radius: 0.3em;
            -webkit-border-radius: 0.3em;
            border-radius: 0.3em;
            text-align: center;
            text-decoration: none;
            font-size: 1.3em;
            font-weight: bold;
            margin: 0 auto;
        }

        div.form_area_confirm {
            margin: 15px auto 5px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            background: #dddcdc;
            padding: 3%;
            min-height: 150px;
            font-size: 1.1em !important;
            margin: 2%;
        }
        div.rewrite_area {
            position: relative;
            height: 42px;
        }
        a.sub_delete.re_write, .sub_delete.re_write {
            padding-left: 37px;
            letter-spacing: -0.05em;
            margin-right: 10px;
            margin-top: 3px;
        }

        div.rewrite_area button {
            position: absolute;
            top: 0;
            right: 0;
        }
        a.sub_delete, .sub_delete {
            background: #d7d7d7;
            background: -moz-linear-gradient(top, #d7d7d7 0%, #d7d7d7 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d7d7d7), color-stop(100%,#d7d7d7));
            background: -webkit-linear-gradient(top, #d7d7d7 0%,#d7d7d7 100%);
            border: 1px solid #d7d7d7;
            color: #564f4e;
            text-shadow: 0px 1px #ffffff;
            position: relative;
        }
        a.re_write::before, .re_write::before {
            background: url(/img/btn_pencil.png) no-repeat;
            -moz-background-size: 30px;
            -webkit-background-size: 30px;
            background-size: 30px;
        }

        a.sub_delete::before, .sub_delete::before {
            position: absolute;
            left: 5px;
            top: 5px;
            display: block;
            content: "";
            width: 30px;
            height: 30px;
        }
        a.forward_siteclr, .forward_siteclr {
            background: #5179f1;
            background: -moz-linear-gradient(top, #5179f1 0%, #5179f1 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#5179f1), color-stop(100%,#5179f1));
            background: -webkit-linear-gradient(top, #5179f1 0%,#5179f1 100%);
            border: 1px solid #5179f1;
            color: #ffffff;
            text-shadow: 1px 1px 1px #223b87;
            margin: 15px auto;
            -moz-border-radius: 0.5em;
            -webkit-border-radius: 0.5em;
            border-radius: 0.5em;
            position: relative;
        }

        a.btn_normal, .btn_normal {
            width: 90%;
            line-height: 50px;
        }
        hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid #cccccc;
            margin: 1em 0;
            padding: 0;
        }
        #container_after p a {
            display: initial;
            color: #007aff;
        }
    </style>
@endsection

@section('content')
    <div id="container">

        <!-- ▼ Teller Profile ▼ -->
        <section id="teller_profile">
            <h1 class="cap">
          <span class="name">{{$info['character_name']}}様<br>
{{--            <span class="genre">ｽﾋﾟﾘﾁｭｱﾙ</span>--}}
          </span>
            </h1>

            <!-- ▲ Teller Profile ▲ -->

            <div id="container_inner" class="m-3">
                <!-- ▼ Summary ▼ -->
                <p class="summary">下記内容でよろしければ【返信する】ボタンをタップしてください。</p>
                <!-- ▲ Summary ▲ -->
                @if($errors)
                    <p class="err_msg text-center text-red">{{$errors->first()}}</p>
                @endif
                <!-- ▼ Form ▼ -->
                <form method="POST">
                    @csrf
                    <div class="form_area_confirm">
                        <label class="form_area w-100" disabled style="background: none; white-space: pre-line">{{$info['question_content']}}</label>
                        <textarea class="d-none" name="question_content" rows="7">{{$info['question_content']}}</textarea>
                    </div>
                    <div class="photo {{$info['image_url']?'':'d-none'}}" style="margin: 20px;">
                        <img src="{{$info['image_url']?$info['image_url']:''}}" style="width: 100px">
                    </div>
                    <div class="rewrite_area">
                        <label name="btnBack" value=" 書き直す " class="btn_base btn_short sub_delete re_write">書き直す</label>
                    </div>
                    <input type="hidden" name="character_id" value="{{$info['character_id']}}">
                    <input type="hidden" name="question_id" value="{{$info['question_id']}}">
                    <input type="hidden" name="image_url" value="{{$info['image_url']?$info['image_url']:''}}">
                    @if($info['need_point'])
                        <div class="card-body">
                            <button type="button" class="btn_base btn_normal forward_siteclr" data-toggle="modal" data-target="#exampleModal">この内容で返信する</button>
                        </div>
                    @else
                        <input id="submit" value=" この内容で返信する " class="btn_base btn_normal forward_siteclr" style="cursor: pointer">
                    @endif

                </form>
                <!-- ▲ Form ▲ -->
            </div>
            <div id="container_after" class="m-3" style="display: none">
                <h3 class="data_finish">メールの送信が完了しました</h3>
                <hr>
                <!-- ▼ Summary ▼ -->
                <p class="summary">ご相談くださった内容につきましては、24時間以内にご返信いたします。お休みの場合でも、48時間以内には必ずお返事が届きます。<br>
                    <br>
                    ※万が一48時間以内に返信がない場合には、<a href="{{'question'}}">サポート窓口</a>までご報告ください。<br>未返信分のポイントを返還させていただきます。</p>
                <!-- ▲ Summary ▲ -->
            </div>
        </section>


    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="top: 20%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">ポイントが足りません。</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>【運営事務局より】ポイント不足の為、お相手様へのメッセージは送信できません。
                        「ポイント購入」メニューよりポイントを追加後に再度メッセージを送信してください。</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                    <a href="{{url('/point-list')}}" type="button" class="btn btn-primary">ポイント購入はこちら</a>
                </div>
            </div>
        </div>
    </div>
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
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            $('[name="btnBack"]').click(function () {
                window.history.back();

            });
            $('#submit').click(function () {
                var home_path = $("#home_path").val();
                var token = $("meta[name='_csrf']").attr("content");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                var url = home_path + '/send_chat';
                var form = $('form')[0];
                // You need to use standard javascript object here
                var formData = new FormData(form);
                $.ajax({
                    url:url,
                    type:'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $.growl.notice({
                            title: "成功",
                            message: "送信いたしました",
                            duration: 3000
                        });
                        $('#container_inner').hide();
                        $('#container_after').show();

                    },
                    error: function () {
                        $.growl.warning({
                            title: "警告",
                            message: "失敗しました",
                            duration: 3000
                        });
                        return false;
                    }
                });

            })

        });
    </script>
@endsection
