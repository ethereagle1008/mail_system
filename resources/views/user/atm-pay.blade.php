@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>

    </style>
@endsection

@section('content')
    <div id="container" style="font-size:x-small; margin:0 auto;" align="center">

        <img src="{{asset('/img/ginhuri_top.gif')}}" alt="銀行振込みについて" style="width: 230px !important;"><br>
        <br>
        <div style="text-align:left;" class="text-medium-xs mx-3">

            <!-- お客様ＩＤ番号 -->
            ※お振込み名義の欄には必ずお客様の名前ではなく、<span style="color:#ff4981">ID番号</span>をご記入下さい。<br>
            <br>
            ID番号：<span style="color:#ff4981">{{$unique_id}}</span><br>
            <br>
        </div>

        <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">

        <!-- 後払い -->
        <div style="text-align:left;">

        </div>
        <!-- お振込先 -->

        <table border="1" bgcolor="#ffffcc" style="width: 55%">
            <tbody>
            <tr>
                <td>
                    <div style="text-align:center; font-size:x-small;" class="text-medium-xs">
                        <span style="color:#ff4981">■お振込先</span><br>
                        みずほ銀行<br>
                        恵比寿支店<br>
                        (普)1560522<br>
                        ｶ)ｱﾄﾘｴ<br>
                        <img src="{{asset('/img/F977.gif')}}" class="width-1" border="0"><a href="{{url('/bank-port')}}">お振込先をﾒｰﾙで受け取る</a><br>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <!-- 料金 -->
        <div style="text-align:left;" class="text-medium-xs">
            <div style="background:#ffa9a9; color:#fff;">■料金</div>
            <div class="mx-3 pt-3">
                @foreach($point_prices as $price)
                    {{$price->price}}円：{{$price->point}}pt<br>
                @endforeach
            </div>
        </div>
        <br>
        <!-- お急ぎの方へ -->
        <div style="text-align:left;" class="text-medium-xs">
            <div style="background:#ffa9a9; color:#fff;">■銀行窓口営業時間外のお振込みについて</div>
            <div class="mx-3">
                当ｻｲﾄで取り扱っております銀行の24時間対応に伴い、当ｻｲﾄｻﾎﾟｰﾄ窓口対応時間の9時～23時までの銀行振込みでのﾎﾟｲﾝﾄ追加が可能となりました。<br>
                <br>
                尚、一部の金融機関においては24時間対応を行っていない場合もございますので、銀行窓口営業時間外（平日15時以降）、及び土日祝日のお振込みをされる際にはﾎﾟｲﾝﾄ反映がされるまで「お振込み明細書」をお持ちいただきますようお願いいたします。<br>
                <br>
                また、大変恐縮ではございますが、<font
                    color="#ff4981">指定日振込をされた際には「お振込み明細書」を必ずｻﾎﾟｰﾄ窓口まで</font>お送りいただく必要がございますので、予めご了承ください。<br>
                <br>
                <font color="#ff4981">※祝日・振替休日に関しましては、指定銀行の都合により翌営業日の確認となってしまいますので、お急ぎの方は【写ﾒ（FAX）振込み】をご利用ください。<br>
                    また、土日のご入金に関しましては、ご入金確認が可能な時間が限られておりますので、詳しくは<a
                        href="https://www.mizuhobank.co.jp/corporate/ebservice/account/b_web/index.html">こちら</a>をご確認いただき、時間外のご入金をされた方でお急ぎの方は、【写ﾒ（FAX）振込み】をご利用ください。</font>

            </div>
        </div>

        <!-- 注意事項 -->
        <div style="text-align:left;" class="text-medium-xs">
            <div style="background:#ffa9a9; color:#fff;">■注意事項</div>
            <div class="mx-3">
                ※お振込み名義の欄には必ずお客様のお名前ではなく、<span style="color:#ff4981">会員ID番号</span>をご記入下さい。<br>
                <br>
                <div align="center">
                    会員ID番号：<span style="color:#ff4981">{{$unique_id}}</span><br>
                </div>
                <br>
                ※ID番号の確認ができないお振込みに関しては、ﾎﾟｲﾝﾄ追加することができません。弊社では一切責任を負いかねますのでご注意ください。<br>
                ※誤って口座名義人にてお振込みされた場合は、すぐに<a href="{{url('/question')}}">ｻﾎﾟｰﾄ窓口</a>までご連絡ください。<br>
                ※振込手数料は、お客様のご負担となります。<br>
            </div>

        </div>

        <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">
        <a href="{{url('/point-list')}}">他の支払い方法</a>
        <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">
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
