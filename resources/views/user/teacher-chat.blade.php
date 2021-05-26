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

        /*html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp, small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    border: 0;*/
        /*    outline: 0;*/
        /*    font-size: 100%;*/
        /*    !* vertical-align: baseline; *!*/
        /*    background: transparent;*/
        /*}*/

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

        a.pencil_btn {
            width: 95%;
            border: 1px solid #5b8c21;
            color: #5b8c21;
        }

        a.favorite_btn, a.pencil_btn {
            display: block;
            float: right;
            margin: 10px 0px 0px 0px;
            padding: 3px 5px 3px 0px;
            /*width: 130px;*/
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            /*font-size: 1.4em;*/
            font-weight: bold;
            line-height: 1.4;
            text-align: center;
        }

        a {
            margin: 0;
            padding: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent;
        }

        a.small {
            width: 95%;
            border: 1px solid #e4697b;
        }

        a.favorite_btn {
            border: 2px solid #e4697b;
            color: #e4697b;
        }

        a.favorite_btn img, a.pencil_btn img {
            width: 20px;
            height: 20px;
            padding-right: 5px;
        }

        p {
            color: #564f4e;
            line-height: 135%;
            letter-spacing: -0.01em;
            text-align: justify;
            text-justify: distribute-all-lines;
        }

        #consultation_form {
            background: #f3f3f3;
        }
        #consultation_form h1.cap {
            padding: 10px 10px 10px 10px;
            -moz-border-radius: 0px;
            -webkit-border-radius: 0px;
            border-radius: 0px;
            /*font-size: 1.6em;*/
            letter-spacing: 0.03rem;
            position: relative;
        }

        #consultation_form a.btn_short {
            margin: 0px 5% 15px 2%;
            padding-left: 30px;
            -moz-border-radius: 0.5em;
            -webkit-border-radius: 0.5em;
            border-radius: 0.5em;
            font-size: 1.3em;
            height: 51px;
            line-height: 52px;
        }

        a.action, .action {
            background: #feca5d;
            background: -moz-linear-gradient(top, #feca5d 0%, #feca5d 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#feca5d), color-stop(100%,#feca5d));
            background: -webkit-linear-gradient(top, #feca5d 0%,#feca5d 100%);
            color: #84441a !important;
            text-shadow: 1px 1px 1px #ffdba5;
            position: relative;
            margin-top: 10px;
            margin-bottom: 10px;
            display: block !important;
            border-style: none;
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
        textarea.form_area{
            margin:15px auto;
            -moz-box-sizing:border-box;
            -webkit-box-sizing:border-box;
            box-sizing:border-box;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            border-radius:3px;
            border:1px solid #b3b5b5;
            width:95%;
            display:block;
            /*font-size:1.5em !important;*/

        }
        a.action_camera::before, .action_camera::before {
            background: url(/img/action_btn_camera.png) no-repeat;
            -moz-background-size: 30px;
            -webkit-background-size: 30px;
            background-size: 30px;
        }

        a.action::before, .action::before {
            position: absolute;
            left: 8%;
            top: 19%;
            display: block;
            content: "";
            width: 30px;
            height: 30px;
        }

        #consultation_form input.btn_half {
            margin-right: 2%;
            margin-top: 0px;
        }
        #favorite_tellerbox a.btn_half, #consultation_form input.btn_half {
            float: right;
            width: 55%;
            font-size: 1.3em;
        }
        input.btn_half {
            height: 51px;
            line-height: 45px;
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
        a.btn_half, .btn_half {
            width: 45%;
            height: 50px;
            line-height: 50px;
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
        #consultation_form .fsz_free {
            font-size: 1em;
        }

    </style>
@endsection

@section('content')

    <div id="container">
        <!--        <div id="container_inner"> -->

        <!-- ▼ Teller Profile box ▼ -->
        <section id="teller_profile">
            <h1 class="cap">
                <!--<span class="ribbon"><img src="/m999/img/members/sm/img/caption_ribbon.png" alt=""></span>-->
                <span class="name">{{$character->name}}様<br>
                    <span class="genre"></span>
                </span>
            </h1>
            <article class="card-body profile_body cf" style="min-height: 400px;">
                <div class="description">
                    <figure><img src="{{$character->image}}" alt=""></figure>
                    <a href="#consultation_form_anchor" class="pencil_btn fsz12"><img src="{{asset('img/pencil.png')}}"
                                                                                      alt="この先生に相談">メッセージを送る</a>
{{--                    <a href="" class="favorite_btn small fsz12"><img src="{{asset('img/favorite.png')}}" alt="お気に入り">My鑑定師追加</a>--}}
                </div><!--/.description-->
                <p style="white-space: pre-line">{{$character->description}}
                </p>
            </article><!--/.profile_body-->
        </section>
        <!-- ▲ Teller Profile box ▲ -->


        <!-- ▼ Consultation Form ▼ -->
        <span id="consultation_form_anchor"></span>
        <section id="consultation_form">
            <h1 class="cap">返信はこちら</h1>

            <form action="{{url('/teacher-confirm')}}" method="POST" class="mx-3" enctype="multipart/form-data">
                @csrf
                <div class="count_wrap"><span class="count">0</span>文字</div>
                @if($errors)
                    <p class="err_msg text-center text-red">{{$errors->first()}}</p>
                @endif
                <textarea class="form_area" name="question_content" rows="10" required
                          placeholder="※全角1,000文字以内でご入力ください。"></textarea>
                <div class="preview" style="margin: 20px;">
                    <img id="photo-preview" src="" alt="no_img" style=" width: 100px">
                    <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                </div>
                <input type="hidden" name="character_id" value="{{$character->id}}">
                <input type="submit" value=" 入力内容を確認する " class="btn_base btn_half forward_siteclr">
                <a class="mx-3 btn_base btn_short action deco action_camera" onclick="openFile()">写真を添付</a>
                <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
            </form>


            <div class="m-3 form_note">
                <p class="fsz_free">
                    ※写真を添付したい場合は、「写真を添付」ボタンより、メールに写真を添付し、そのまま送信してください。折り返し、確認メールが届きますので、そちらよりご相談内容をご入力下さい。<br>
                    ※1回のご相談で複数の写真を添付することはできません。</p>
            </div><!--/.form_note-->
        </section>
        <!-- ▲ Consultation Form ▲ -->

        <!--    </div> --><!--#container_inner-->

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.preview').hide();
           $('[name="textarea-mBody"]').change(function () {
               var txt = $(this).val()
               console.log(txt.length);
               $(this).prev().prev().find('span.count').text(txt.length);
           })
            $('.form_area,.form textarea').bind('keyup',function(){
                counter = $(this).val().length;
                $('.count').html(counter);
                if(counter > '1000') {
                    $('.count_error_txt').text('全角1000文字以内でご入力ください');
                    $('.count_error_txt').css('margin-top','10px');
                    $('.count_error_txt').css('color','red');
                    $('input[type="submit"]').prop('disabled', true);
                    $('input[type="submit"]').css('opacity', '0.5');
                } else {
                    $('input[type="submit"]').prop("disabled", false);
                    $('input[type="submit"]').css('opacity', '1');
                }
            });

            $('.form_area,.form textarea').blur(function(){
                counter = $(this).val().length;
                $('.count').html(counter);
                if(counter > '1000') {
                    $('.count_error_txt').text('全角1000文字以内でご入力ください');
                    $('.count_error_txt').css('margin-top','10px');
                    $('.count_error_txt').css('color','red');
                    $('input[type="submit"]').prop('disabled', true);
                    $('input[type="submit"]').css('opacity', '0.5');
                } else {
                    $('input[type="submit"]').prop("disabled", false);
                    $('input[type="submit"]').css('opacity', '1');
                }
            });
        });
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
    </script>
@endsection
