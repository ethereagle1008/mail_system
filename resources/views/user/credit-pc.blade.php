@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
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
        #container_inner {
            padding: 0 2%;
        }
        #container p {
            margin: 10px 0;
        }
        .summary {
            margin-bottom: 15px;
            margin-top: 10px;
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
            font-size: 1.2em;
            font-weight: bold;
            margin: 0 auto;
        }
        #container p {
            margin: 10px 0;
        }

        .str_clr {
            color: #f32f20;
        }
        section#select_wrap {
            background: #f6f2e4;
            padding: 15px 2%;
            margin-bottom: 15px;
        }
        select.select_design {
            width: 100%;
            padding: 10px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid #4683c0;
            background: #eee;
            background: url(img/pulldown_arrow.png) right 50% no-repeat, -webkit-linear-gradient(top, #fff 0%,#efebe1 100%);
            background: url(img/pulldown_arrow.png) right 50% no-repeat, linear-gradient(to bottom, #fff 0%,#efebe1 100%);
            background-size: 24px, 100%;
            font-size: 0.9em;
        }

        select.select_design {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
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
        .note {
            color: #96908f;
            border: none;
        }

        .fsz12 {
            font-size: 1em;
        }
    </style>
@endsection

@section('content')
    <div id="container">

        <h1 class="official">クレジットカード決済</h1>
        <div id="container_inner">

            <p class="logo_area"><img src="{{asset('img/captionLogo_jcb.jpg')}}" alt="ロゴ" width="100%">
            </p>

            <!-- ▼ Summary ▼ -->
            <section class="summary mx-3">
                <p>JCBのクレジットカードがご利用になれます。</p>

                <a class="btn_base btn_normal general"
                   href="https://gw.axes-payment.com/cgi-bin/mobile_exp.cgi?clientip=1011003615">決済に関する説明を読む</a>
                <br>
                <p class="str_clr">※必ずお読みの上、決済画面へお進みください。</p>
            </section>
            <!-- ▲ Summary ▲ -->
        </div><!--/#container_inner-->


        <section id="select_wrap" class="mx-3">
            <div id="step_inner">
                <p class="summary">ご希望の購入ポイント額を選択してください。</p>
{{--                <form action="https://gw.axes-payment.com/cgi-bin/credit/order.cgi" method="POST"--}}
{{--                      enctype="x-www-form-encoded" target="_brank">--}}
                <form action="{{url('/pay')}}" method="POST">
                    @csrf
                    <input type="hidden" name="unique_id" value="{{$unique_id}}">
                    <input type="hidden" name="price" value="2000">
                    <input type="hidden" name="point" value="200">
                    <input type="hidden" name="pay_type" value="jcb_pay">

                    <p class="summary">▼購入希望ポイント(金額)
                        <br>
                        <select name="select_price" class="select_design" style="font-size:16px;">
                            @foreach($point_prices as $price)
                                <option value="{{$price->price}}">{{$price->point}}pt({{$price->price}}円)</option>
                            @endforeach
                        </select></p>
                    <input type="submit" value=" 決済画面へ進む " class="btn_base btn_normal forward">
                </form>

                <p class="note fsz12">※決済画面ボタンをタップすると株式会社AXES Paymentの画面に移動します。</p>
            </div><!--/#step_inner-->
        </section>


        <div id="container_inner" class="mx-3">
            <section id="content_conf">
                <b class="fsz14">■JCBカード決済に関するお問い合わせ</b><br>
                <br>
                <p>決済システムは、株式会社AXES Paymentを利用しています。<br>決済に関するお問い合わせはAXES Paymentカスタマーサポートセンターにて24時間365日受け付けております。<br>
                    TEL:0570-03-6000（ナビダイヤル）<br>
                    TEL:03-3498-6200<br>
                    E-mail:<a href="mailto:creditinfo@axes-payment.co.jp">creditinfo@axes-payment.co.jp</a></p>
                <br>
                <br>
                <b class="fsz14">■クレジットカード情報の取り扱いについて</b><br>
                <br>
                <p>お客様にご入力いただいたクレジットカード情報の保管に関しまして、ご確認ください。</p><br>
                <ol>
                    <li>1.クレジットカード情報は、お買上げいただいた商品（ポイント）代金の決済のみに利用させていただきます。</li>
                    <li>2.クレジット決済は、決済代行会社（株式会社AXES Payment）を通じて行っています。(決済代行会社では、決済後一定期間経過後にクレジット情報を消去いたします。)</li>
                    <li>3.当社では一切クレジットカード情報は保管しておりません。</li>
                </ol>
                <br>
                <p>※ご不明な点がございましたら、お気軽に<a href="{{url('/question')}}">サポート窓口</a>へお問い合わせください。
                </p>
            </section>
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
            $('[name="select_price"]').change(function () {
                var sel_txt = $(this)[0].options[$(this)[0].selectedIndex].text;
                $('[name=price]').val($(this).val());
                var res = sel_txt.split("pt")
                $('[name=point]').val(res[0]);
            })

        });
    </script>
@endsection
