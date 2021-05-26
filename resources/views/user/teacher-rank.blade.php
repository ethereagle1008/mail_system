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
    <div id="container" style="font-size:x-small;  width:240px; margin:0 auto;" align="center">

        <img src="{{asset('img/y-star.png')}}" class="height-1 img-icon" border="0"><span class="text-large-xs">ﾗﾝｷﾝｸﾞ</span><img src="{{asset('img/y-star.png')}}" class="height-1 img-icon" border="0"><br>
        <hr style="border:none; height:1px; border-top: 1px solid #4f4339; width:100%;">

        <div style="text-align:left;" class="text-medium-xs">
            @if(count($characters) == 0)
                <p class="m-3 text-medium-xs" style="color: red"></p>
            @else
                <br>
                @foreach($characters as $index => $character)
                    {{$index + 1}}位　<a href="{{url('/teacher-chat/'. $character->id)}}">{{$character->name}}</a><br>
                    <br>
                @endforeach
            @endif
        </div>

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

@endsection
