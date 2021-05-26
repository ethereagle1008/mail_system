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
        .fsz9 {
            font-size: 0.6em;
        }
        .summary {
            margin-bottom: 15px;
            margin-top: 10px;
        }
        div.annot2_frame {
            border: 4px solid #f32f20;
        }

        div.annot_area {
            background: #ffffff;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -moz-border-radius: 7px;
            -webkit-border-radius: 7px;
            border-radius: 7px;
            margin-bottom: 15px;
        }
        h2.cap {
            position: relative;
        }

        h2.annot2 {
            background: #f32f20;
        }
        h2 {
            padding: 15px 0px 15px 45px;
            margin-bottom: 15px;
            font-size: 1.2em;
            font-weight: bold;
            letter-spacing: 0.03rem;
            color: #ffffff;
            -moz-border-radius: 2px 2px 0px 0px;
            -webkit-border-radius: 2px 2px 0px 0px;
            border-radius: 2px 2px 0px 0px;
        }
        h2.cap::after {
            content: "";
            display: block;
            position: absolute;
            left: 5px;
            top: 12px;
            width: 45px;
            height: 45px;
            background-size: 66% auto !important;
        }

        h2.annot2::after {
            background: url(/img/caution_caption.png) no-repeat;
        }
        div.annot_txt {
            padding: 0 2%;
            margin-bottom: 15px;
        }
        .str_clr {
            color: #f32f20;
        }
        #container p {
            margin: 10px 0;
        }

        .note {
            color: #96908f;
            border: none;
        }
    </style>
@endsection

@section('content')
    <div id="container">

        <h1 class="official">銀行振込&nbsp;<span class="fsz9">(窓口•ATM)</span></h1>
        <div id="container_inner">

            <!-- ▼ Summary ▼ -->
            <section class="summary mx-3">
                <p>当サイトにご登録いただいている携帯アドレス宛に、振込み先ご案内メールをお送りしました。
                </p>
                <br>
                <p>
                    ご入金の確認が取れ次第、ポイントが追加されます。<br>
                    ※混雑状況などにより多少のお時間を頂戴する場合もございます。予めご了承ください。
                    <br>
                    ※ご不明な点がございましたら、お気軽に<a href="{{url('/question')}}">サポート窓口</a>までお問い合わせください。
                </p>
            </section>
            <!-- ▲ Summary ▲ -->

            <div class="annot_area annot2_frame">
                <h2 class="annot2 cap">ご注意</h2>
                <div class="annot_txt">
                    <p>お振込み名義は、お客様の名前ではなく、必ず<span class="str_clr">会員ID番号</span>をご記入下さい。</p>
                    <p style="text-align:center;">みちこさんの会員ID<span class="fsz16 str_clr">【{{$unique_id}}】</span></p>
                    <p class="note">
                        ※ID番号の確認ができないお振込みに関しては、ポイントを追加することができません。誤って口座名義人にてお振込みされた場合は、すぐに<a
                            href="{{url('/question')}}">サポート窓口</a>までご連絡ください。
                        <br>
                        ※振込手数料は、お客様のご負担となります。</p>
                </div><!--/.annot_txt-->
            </div><!--/.annot_area annot2_frame-->

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
