@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        img {
            width: auto !important;
        }
    </style>
@endsection

@section('content')
    <div id="container" style="font-size:x-small; margin:0 auto; width:90%;" align="center" class="text-medium-xs">


        <img src="{{asset('/img/creca_top.gif')}}" alt="クレジットカード決済について" width="230" height="150"><br>

        ご利用になるｶｰﾄﾞ会社をお選びください。<br>
        <br>

        <div align="center" class="text-medium-xs"><img src="{{asset('/img/logo_visa.gif')}}" width="70" height="60" border="0">　<img src="{{asset('/img/logo_master.gif')}}" width="70" height="60" border="0"><br>
            <font><a href="{{url('/credit-tel')}}">≫VISA/MasterCardの方はｺﾁﾗ</a></font></div>
        <br>

        <!-- <div align="center"><img src="/m999/img/acc/logo_visa.gif" width="70" height="60" border="0">　<img src="/m999/img/acc/logo_master.gif" width="70" height="60" border="0"><br>
          <font size="-2"><a href="/point/gmoCredit.php?pp=38w7i4hv8cspn5jw">≫VISA/MasterCardの方はｺﾁﾗ</a></font></div>-->
        <br>

        <div align="center" class="text-medium-xs">
            <img src="{{asset('/img/logo_jcb.gif')}}" width="70" height="60" border="0" alt="JCB"><br>
            <a href="{{url('/credit-pc')}}">≫JCBの方はｺﾁﾗ</a>
        </div>
        <br>

        <!--<div align="center">
        <img src="/m999/img/acc/logo_ae.gif" width="70" height="60" border="0" alt="AMEX"><br />
        <a href="/point/digica.php?pp=38w7i4hv8cspn5jw">≫AMEXの方はｺﾁﾗ</a>
        </div>
        <br />
        <br />-->
        ※ご不明な点がございましたら、お気軽に<a href="{{url('/question')}}">ｻﾎﾟｰﾄ窓口</a>へお問い合わせください。



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
