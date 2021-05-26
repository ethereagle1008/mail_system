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
            background: url(img/pulldown_arrow.png) right 50% no-repeat, -webkit-linear-gradient(top, #fff 0%, #efebe1 100%);
            background: url(img/pulldown_arrow.png) right 50% no-repeat, linear-gradient(to bottom, #fff 0%, #efebe1 100%);
            background-size: 24px, 100%;
            font-size: 0.9em;
        }

        select.select_design {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }


        .note {
            color: #96908f;
            border: none;
        }

        .fsz12 {
            font-size: 1em;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        table {
            margin: 0 auto 15px;
            width: 100%;
            border: 1px solid #b3b5b5;
            border-collapse: collapse;
            table-layout: fixed;
            word-wrap: break-word;
        }
        tr {
            background: #f5f4f2;
        }
        section#content_conf table.conf th.ttl_left {
            line-height: 1em;
            border-bottom: 1px solid #b3b5b5;
            width: 35%;
        }

        th {
            background: #6f6f6e;
            padding: 15px;
            font-size: 1em;
            color: #ffffff;
            text-align: center;
            line-height: 1em;
        }
        section#content_conf table.conf td {
            text-align: right;
        }

        td {
            padding: 2%;
            font-size: 1em;
            line-height: 125%;
            letter-spacing: -0.01em;
            text-align: justify;
            border: 1px solid #b3b5b5;
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

    </style>
@endsection

@section('content')
    <div id="container">

        <h1 class="official">クレジットカード決済</h1>
        <div id="container_inner">

            <!-- ▼ Summary ▼ -->
            <section class="summary">
                <p>以下の内容を確認し、よろしければ『決済画面へ進む』ボタンをタップしてください。</p>
            </section>
            <!-- ▲ Summary ▲ -->

            <section id="content_conf" class="mx-3">
{{--                <form action="https://secure.telecomcredit.co.jp/inetcredit/secure/order.pl" method="POST">--}}
                <form action="{{url('/pay')}}" method="POST">
                    @csrf
                    <input type="hidden" name="unique_id" value="{{$unique_id}}">
                    <input type="hidden" name="price" value="{{$price}}">
                    <input type="hidden" name="point" value="{{$point}}">
                    <input type="hidden" name="pay_type" value="card_pay">
{{--                    <input type="hidden" name="redirect_back_url"--}}
{{--                           value="http://spidoor.jp/menu.php?pp=38w7i4hv8cspn5jw">--}}

                    <p></p>
                    <table border="1" cellpadding="0" class="conf">
                        <tbody>
                        <tr>
                            <th class="ttl_left">購入ポイント</th>
                            <td>{{$point}}pt</td>
                        </tr>
                        <tr>
                            <th class="ttl_left">購入金額</th>
                            <td>{{$price}}円</td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="submit" name="telecom" value="決済画面へ進む" class="btn_base btn_normal forward"></form>
                <p class="note fsz12">※決済画面ボタンをタップするとテレコムクレジット(株)の画面に移動します。</p>
                <br>

                <b class="fsz14">■クレジットカード情報の取り扱いについて</b><br>

                <p>お客様にご入力いただいたクレジットカード情報の保管に関しまして、ご確認ください。</p>
                <ol>
                    <li>1.クレジットカード情報は、お買上げいただいた商品（ポイント）代金の決済のみに利用させていただきます。</li>
                    <li>2.クレジット決済は、決済代行会社（テレコムクレジット株式会社）を通じて行っています。(決済代行会社では、決済後一定期間経過後にクレジット情報を消去いたします。)</li>
                    <li>3.当社では一切クレジットカード情報は保管しておりません。</li>
                </ol>
                <br>
                <b class="fsz14">■返品/返金の可否について</b><br>
                <p>購入ポイントのご使用後は、サービスの性質上故意または重過失に起因する事由に直接基づく場合を除いて､ご利用料金の払い戻しはいたしません。</p>

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

        });
    </script>
@endsection
