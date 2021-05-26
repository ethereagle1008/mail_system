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
    <div id="container" style="font-size:x-small; margin:0 auto; width:85%;" align="center">

        <img src="{{asset('img/post.gif')}}" class="height-1 img-icon mb-1" border="0"><font style="vertical-align: inherit;" class="text-large-xs"><font
                 style="vertical-align: inherit;">送受信履歴</font></font><img src="{{asset('img/post.gif')}}" class="height-1 img-icon mb-1" border="0"><br>
        <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">
        @if(count($mails) == 0)
            <p class="m-3 text-medium-xs" style="color: red">受信ﾒｰﾙはありません。</p>
            <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">
        @else
            @foreach($mails as $mail)

                <img src="{{asset('img/date.gif')}}" class="height-1 img-icon mb-1" border="0"><span style="color:#41A7FF;" class="text-medium-xs"><font
                        style="vertical-align: inherit;"><font style="vertical-align: inherit;">受信日</font></font></span><br>
                <span style="color:#41A7FF;" class="text-medium-xs"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$mail->receive_date}}</font></font></span><br>
                @if($mail->type == 'character_sent')
                    <img src="{{asset('img/post.gif')}}" class="height-1 img-icon mb-1" border="0"><font style="vertical-align: inherit;" class="text-medium-xs"><font
                            style="vertical-align: inherit;">送信者：{{$mail->c_name}}</font></font><br>
                    <img src="{{asset('img/target.gif')}}" class="height-1 img-icon mb-1" border="0"><font style="vertical-align: inherit;" class="text-medium-xs"><font
                            style="vertical-align: inherit;">受信者：{{$mail->name}}</font></font><br>
                    <img src="{{asset('img/sender.gif')}}" class="height-1 img-icon mb-1" border="0"><a
                        href="{{url('/user-reply/'.$mail->id)}}"><font class="text-medium-xs"
                                      style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$mail->c_name}}様の ご連絡です</font></font></a><br>
                @else
                    <img src="{{asset('img/post.gif')}}" class="height-1 img-icon mb-1" border="0"><font style="vertical-align: inherit;" class="text-medium-xs"><font
                            style="vertical-align: inherit;">送信者：{{$mail->name}}</font></font><br>
                    <img src="{{asset('img/target.gif')}}" class="height-1 img-icon mb-1" border="0"><font style="vertical-align: inherit;" class="text-medium-xs"><font
                            style="vertical-align: inherit;">受信者：{{$mail->c_name}}</font></font><br>
                    <img src="{{asset('img/sender.gif')}}" class="height-1 img-icon mb-1" border="0"><a
                        href="{{url('/user-reply/'.$mail->id)}}"><font class="text-medium-xs"
                                      style="vertical-align: inherit;"><font style="vertical-align: inherit;">[返信メール]</font></font></a><br>
                @endif
                <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">
            @endforeach
                <div class="">
                    {!! $mails->appends($pagination_params)->render() !!}
                </div>
        @endif
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
