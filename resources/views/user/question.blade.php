@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        body {
            font-family: 'Quicksand', "游ゴシック体", "Yu Gothic", YuGothic, "ヒラギノ角ゴシック Pro", "Hiragino Kaku Gothic Pro", 'メイリオ', Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
        }

        h1.official {
            padding: 18px 0px;
            font-size: 1.5em;
            font-weight: bold;
            letter-spacing: 0.03rem;
            line-height: normal;
            background: #3a6b90;
            color: #ffffff;
            text-align: center;
            border-top: 1px solid #79a6c9;
            margin-bottom: 10px;
            margin-top: 0;
        }

        section > p {
            color: #564f4e;
            font-size: 1em;
            line-height: 135%;
            letter-spacing: -0.01em;
            text-align: justify;
            text-justify: distribute-all-lines;
            margin: 15px 10px;
        }
        .note {
            color: #96908f;
            padding: 0;
            border: none;
        }
        a.general, .general {
            background: #91bd04;
            background: -moz-linear-gradient(top, #91bd04 0%, #91bd04 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#91bd04), color-stop(100%,#91bd04));
            background: -webkit-linear-gradient(top, #91bd04 0%,#91bd04 100%);
            border: 1px solid #91bd04;
            /* box-shadow: inset 0 1px 0 rgb(212 253 72 / 80%), inset 1px 0 0 rgb(212 253 72 / 30%), inset -1px 0 0 rgb(212 253 72 / 30%), inset 0 -1px 0 rgb(212 253 72 / 20%); */
            color: #ffffff !important;
            text-shadow: 1px 1px 1px #566d0c;
            position: relative;
            margin-bottom: 20px;
            display: block !important;
        }
        a.sub_action, .sub_action {
            background: #f0eee6;
            border: 1px solid #ccc8bc;
            box-shadow: inset 0 1px 0 rgb(255 255 255 / 80%), inset 1px 0 0 rgb(255 255 255 / 30%), inset -1px 0 0 rgb(255 255 255 / 30%), inset 0 -1px 0 rgb(255 255 255 / 20%);
            -moz-box-shadow: 1px 2px 0 #c0bebe;
            -webkit-box-shadow: 1px 2px 0 #c0bebe;
            box-shadow: 1px 2px 0 #c0bebe;
            color: #564f4e;
            text-shadow: 0px 1px #ffffff;
            padding-left: 35px;
            position: relative;
            margin-bottom: 15px !important;
            margin-top: 10px;
        }
        a.btn_large, .btn_large {
            width: 95%;
            height: 50px;
            line-height: 50px;
        }
        a.btn_normal, .btn_normal {
            width: 90%;
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
        section.contact {
            background: #f7f7f7;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #b3b5b5;
        }
        #contact_mail h2.cap {
            padding: 15px 5px 15px 35px;
        }

        h2.cap {
            position: relative;
        }
        h2.annot1 {
            background: #646464;
        }
        h2 {
            padding: 15px 0px 15px 45px;
            margin-bottom: 15px;
            font-size: 1em;
            font-weight: bold;
            letter-spacing: 0.03rem;
            color: #ffffff;
            -moz-border-radius: 2px 2px 0px 0px;
            -webkit-border-radius: 2px 2px 0px 0px;
            border-radius: 2px 2px 0px 0px;
        }
        section.contact h2 span.aside {
            display: inline;
            font-size: 1.0em;
            color: #ffffff;
        }

        section.contact h2 span {
            display: block;
            font-size: 1.0em;
            font-weight: normal;
            margin-top: 10px;
            line-height: 1.3;
        }
        #contact_mail h2.cap::after {
            top: 5px;
        }

        #contact_mail h2::after {
            background: url(img/form_caption.png) no-repeat;
        }
        a.btn_mail::before, .btn_mail::before {
            background: url(img/btn_mail.png) no-repeat;
            -moz-background-size: 30px;
            -webkit-background-size: 30px;
            background-size: 30px;
        }
        a.sub_action::before, .sub_action::before {
            position: absolute;
            left: 8%;
            top: 19%;
            display: block;
            content: "";
            width: 30px;
            height: 30px;
        }
        h2.cap::after {
            content: "";
            display: block;
            position: absolute;
            left: 5px;
            top: -1px;
            width: 45px;
            height: 45px;
            background-size: 66% auto !important;
        }
        p.err_msg {
            font-size: 1.4em;
            margin-top: 15px;
            padding: 0 3%;
        }
        textarea.form_area {
            margin: 15px auto;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            border: 1px solid #b3b5b5;
            width: 95%;
            display: block;
            font-size: 1em !important;
        }
        input.btn_normal {
            height: 51px;
            line-height: 45px;
        }

        a.forward, .forward {
            background: #2060a1;
            background: -moz-linear-gradient(top, #2060a1 0%, #2060a1 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#2060a1), color-stop(100%,#2060a1));
            background: -webkit-linear-gradient(top, #2060a1 0%,#2060a1 100%);
            border: 1px solid #2160a0;
            /* box-shadow: inset 0 1px 0 rgb(226 240 255 / 80%), inset 1px 0 0 rgb(226 240 255 / 30%), inset -1px 0 0 rgb(226 240 255 / 30%), inset 0 -1px 0 rgb(226 240 255 / 20%); */
            color: #ffffff !important;
            text-shadow: 1px 1px 1px #223b87;
            margin: 15px auto;
            position: relative;
            display: block !important;
        }
        #contact_tel h2.cap::after {
            top: 4px;
        }

        #contact_tel h2::after {
            background: url(img/tel_caption.png) no-repeat;
        }
        h2.cap::after {
            content: "";
            display: block;
            position: absolute;
            left: 5px;
            top: -1px;
            width: 45px;
            height: 45px;
            background-size: 66% auto !important;
        }
        .str_clr {
            color: #f32f20;
        }
        section.contact div.cta_txt {
            width: 90%;
            margin: 0 auto;
        }
        section.contact div.tel_area {
            background: #d4d3d3;
            width: 100%;
            margin: 15px auto;
            padding: 10px 0px;
        }
        a.btn_tel, .btn_tel {
            width: 65%;
            background: #ffffff;
            border: 1px solid #767d87;
            -moz-box-shadow: 1px 3px 0 #727983;
            -webkit-box-shadow: 1px 3px 0 #727983;
            box-shadow: 1px 3px 0 #727983;
            -moz-box-shadow: 0 0 0 3px #fff inset, 0 0 0 3px #fff inset, 0 0 0 4px #c8cdd3 inset;
            -webkit-box-shadow: 0 0 0 3px #fff inset, 0 0 0 3px #fff inset, 0 0 0 4px #c8cdd3 inset;
            box-shadow: 0 0 0 3px #fff inset, 0 0 0 3px #fff inset, 0 0 0 4px #c8cdd3 inset;
            color: #2261a3;
            font-size: 1.2em;
            margin: 0 auto;
            padding-left: 15px;
            box-sizing: border-box;
            -moz-border-radius: 0.3em;
            -webkit-border-radius: 0.3em;
            border-radius: 0.3em;
            overflow: hidden;
            position: relative;
        }
        a.btn_tel::before, .btn_tel::before {
            position: absolute;
            left: 2%;
            top: 18%;
            display: block;
            content: "";
            width: 30px;
            height: 30px;
            background: url(img/btn_tel.png) no-repeat;
            -moz-background-size: 30px;
            -webkit-background-size: 30px;
            background-size: 30px;
        }
        a.btn_tel::after, .btn_tel::after {
            display: block;
            position: absolute;
            bottom: 18px;
            right: 0;
            border-left: 33px solid transparent;
            border-top: 36px solid #f2c352;
            content: "";
        }
    </style>
@endsection

@section('content')
    <div id="container">

        <h1 class="official">お問い合わせ・サポート窓口</h1>
        <div id="container_inner">

            <!-- ▼ Summary ▼ -->
            <section class="summary mb-3">
                <p>当サイトに関するご質問やキャンペーン等の合言葉、機種変更をされた方は、下記お問い合わせフォームよりご連絡ください。</p>

            </section>
            <!-- ▲ Summary ▲ -->


            <!-- ▼ Contact Form ▼ -->
            <section id="contact_mail" class="contact m-3">
                <h2 class="annot1 cap">お問い合わせフォーム
                    <span class="aside">(対応/9:00～23:00)</span>
                    <span>※時間外でのお問い合わせは、翌日9:00より順次応対いたします。</span>
                </h2>

                <form action="{{route('send_question')}}" method="POST">
                    @csrf
                    @if($errors)
                        <p class="err_msg text-center text-red">{{$errors->first()}}</p>
                    @endif
                    <textarea class="form_area" name="question_content" cols="35" rows="10"
                              placeholder="※ここに内容を入力してください(全角1,000文字以内)。"></textarea>
                    <input type="submit" value="お問い合わせ" class="btn_base btn_normal forward">
                </form>
            </section>

            <section id="contact_tel" class="contact mx-3" style="display: none;">
                <h2 class="annot1 cap">お電話でのお問い合わせ
                    <span class="aside">(対応時間/11:00～17:00)</span>
                </h2>
                <div class="cta_txt">
                    <p>お問い合わせの際に、みちこ様の<span class="str_clr">会員ID【{{$unique_id}}】</span>をお伝えいただけましたら、スムーズにご案内できます。</p>
                </div><!--/.cta_txt-->
                <div class="tel_area">
                    <a class="btn_base btn_normal btn_tel" href="tel:03-5447-6278">03-5447-6278</a>
                </div><!--/.tel_area-->
            </section>
            <!-- ▲ Contact Form ▲ -->

        </div><!--/#container_inner-->

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
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
