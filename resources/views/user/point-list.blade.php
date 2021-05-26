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
    <div id="container" style="font-size:x-small; margin:0 auto; width:90%;" align="center">
        <div class="text-large-medium-xs">
            <img src="{{asset('/img/p_kakunin.gif')}}" alt="ﾎﾟｲﾝﾄ確認"><br>
            <br>
            {{$name}}さん<br>
            の現在の保有ﾎﾟｲﾝﾄ<br>
            <span style="color:#ff336d;">{{$point}}</span>pt<br>
            <br>
        </div>

        <div style="text-align:left;" class="text-medium-xs">
            <img src="{{asset('/img/p_kounyu.gif')}}" alt="ﾎﾟｲﾝﾄ購入"><br>
            <span class="text-medium-xs" style="color:#ff336d;"><font>お問い合わせに「ポイント購入希望」とお送りくださいませ。<br>
順次ご対応させていただきます。</font></span><br><br>
{{--            ▼購入方法をお選びください<br>--}}
{{--            ・<a href="{{url('/atm-pay')}}">銀行振込み</a><br>--}}
{{--            ・<a href="{{url('/credit-pay')}}">ｸﾚｼﾞｯﾄ決済</a><br>--}}
{{--            ・<a href="">BitCash</a><br>--}}
{{--            <br>--}}
        </div>

        <!-- ﾎﾟｲﾝﾄ購入方法-->
{{--        <img class="mb-3" src="{{asset('/img/p_houhou.gif')}}" alt="ﾎﾟｲﾝﾄ購入方法"><br>--}}
{{--        <table style="width:100%; border:none;" cellpadding="0" cellspacing="0">--}}

{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <td width="80" style="text-align:center; vartical-align:top;">--}}
{{--                    <img src="{{asset('/img/gin_icon.gif')}}">--}}
{{--                </td>--}}

{{--                <td class="text-medium-xs">--}}
{{--                    <span style="color:#ff336d;">【銀行振込み】</span><br>--}}
{{--                    お近くの銀行やｺﾝﾋﾞﾆのATMから簡単振込み♪<br>--}}
{{--                    <br>--}}
{{--                    <div style="text-align:right;"><a href="{{url('/atm-pay')}}">≫詳細をみる</a></div>--}}
{{--                </td>--}}

{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td colspan="2">--}}
{{--                    <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">--}}
{{--                </td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td width="80" style="text-align:center; vartical-align:top;">--}}
{{--                    <img src="{{asset('/img/card_icon.gif')}}">--}}
{{--                </td>--}}

{{--                <td class="text-medium-xs" >--}}
{{--                    <span style="color:#ff336d;">【ｸﾚｼﾞｯﾄ決済】</span><br>--}}
{{--                    ｸﾚｼﾞｯﾄｶｰﾄﾞをお持ちの方はすぐに購入可能。<br>--}}
{{--                    <!--<span style="color:#f85252;">※古い携帯機種でも決済をご利用できるようになりました♪</span><br />-->--}}
{{--                    <br>--}}
{{--                    <div align="right"><a href="{{url('/credit-pay')}}">≫詳細をみる</a></div>--}}
{{--                </td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td colspan="2">--}}
{{--                    <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">--}}
{{--                </td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td width="80" style="text-align:center; vartical-align:top;">--}}
{{--                    <img src="{{asset('/img/bit_icon.gif')}}">--}}
{{--                </td>--}}
{{--                <td class="text-medium-xs" >--}}
{{--                    <span style="color:#ff336d;">【ｺﾝﾋﾞﾆ決済】</span><br>--}}
{{--                    個人情報入力不要!<br>--}}
{{--                    お近くのｺﾝﾋﾞﾆで手軽に購入できます♪<br>--}}
{{--                    <br>--}}
{{--                    <div align="right"><a href="">≫詳細をみる</a></div>--}}
{{--                </td>--}}
{{--            </tr>--}}


{{--            <tr>--}}
{{--                <td colspan="2">--}}
{{--                    <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
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
