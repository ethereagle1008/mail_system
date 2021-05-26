@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        #single .info {
            background: #f5f5f5;
            padding: 10px 2%;
        }
        #single .info .from p:first-child {
             width: calc(100% - 142px);
            line-height: 1.5em;
        }
        #single .info .from p:first-child span {
            font-weight: bold;
        }
        #single .info .from p:last-child {
            width: 142px;
            float: right;
        }
        #single .info .from p:last-child a {
            color: #fff;
            font-weight: bold;
            background: #fa5e3f;
            border-radius: 3px;
            text-align: center;
            padding: 5px 0;
        }

        a {
            color: #333;
            text-decoration: none;
            display: block;
            word-wrap: break-word;
        }
        #single .info .from p:last-child a i {
            margin-right: 5px;
            padding: 5px 0;
        }
        [class^="icon-"], [class*=" icon-"] {
            font-family: 'icomoon' !important;
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        #single .info .date {
            margin-top: 10px;
        }
        #single .info .date div:last-child {
            width: 232px;
        }

        #single .info .date div:first-child {
            font-size: .8em;
            line-height: 1;

        }
        #single .content {
            padding: 2%;
            overflow: hidden;
            width: 100%;
        }
        #single .content .title {
            padding: 10px 50px 10px 5px;
            font-weight: bold;
            border-bottom: 1px solid #eff2f5;
            position: relative;
            line-height: 1.5em;
        }
        #single .content .title p.save {
            color: #c1c1c1;
            font-size: 26px;
            padding: 10px;
            position: absolute;
            right: 5px;
            top: -2px;
        }
        #single .content > p {
            padding: 10px 2% 20px;
            line-height: 1.3em;
        }
        h1.top {
            background: #2f1f11;
            background: -moz-linear-gradient(top, #785e47 0%, #2f1f11 100%);
            background: -webkit-linear-gradient(top, #785e47 0%,#2f1f11 100%);
            background: linear-gradient(to bottom, #785e47 0%,#2f1f11 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2f1f11', endColorstr='#533d2a',GradientType=0 );
        }

        h1 {
            color: #fff;
            font-weight: normal;
            line-height: 1;
            padding: 8px 0;
            font-size: 1em;
            font-weight: bold;
            text-align: center;
            position: relative;
        }
        h1:after {
            background: url(../img/texture.png);
        }

        h1:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
        }
        #single .photo {
            padding: 10px 2%;
        }
        #single .photo a {
            border: 1px solid #533d2a;
            color: #533d2a;
        }

        #single .photo a {
            border-radius: 3px;
            padding: 12px 0;
            position: relative;
            line-height: 1;
            font-weight: bold;
            text-align: center;
        }
        #single .photo a i {
            position: absolute;
            top: 50%;
            left: 3%;
            margin-top: -.8rem;
            font-size: 1.6rem;
        }
        .typeGenre li a::after, #career ul.list li a::after, #single .photo a::after {
            border-top: 3px solid #533d2a;
            border-right: 3px solid #533d2a;
        }

        .typeGenre li a::after, #career ul.list li a::after, #single .photo a::after {
            content: "";
            width: 6px;
            height: 6px;
            position: absolute;
            top: 50%;
            right: 5px;
            transform: rotate(
                45deg
            );
            -webkit-transform: rotate(
                45deg
            );
            -moz-transform: rotate(45deg);
            margin-top: -3px;
        }
        #single .form {
            padding: 0 2% 10px 2%;
        }
        #single .form .count_wrap {
            font-size: 0.8em;
        }
        #single .form .count_error_txt {
            padding: 0;
        }

        #reply p {
            font-size: .7em;
            line-height: 1.5em;
            padding: 5px;
        }
        #single .form textarea {
            background: #f5f5f5;
            border: 1px solid #d7d7d7;
            padding: 10px;
            height: 185px;
            font-size: .7em;
        }

        input, select, textarea {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            header li a: "Noto Sans Japanese", sans-serif;
            color: #333;
            width: 100%;
            border-radius: 3px;
            display: block;
        }
        #single .form input[type="submit"] {
            color: #fff;
            background: #fa5e3f;
            border: 0;
            padding: 10px 0;
            text-align: center;
            font-size: 1.1rem;
            width: 70%;
            margin: 10px auto;
        }
        #reply p {
            font-size: .7em;
            line-height: 1.5em;
            padding: 5px;
        }
        #single .detail {
            text-align: center;
            background: #f5f5f5;
        }
        #single .detail ul {
            padding: 10px 2%;
            display: table;
            margin: 0 auto;
        }
        #single .detail li:first-child {
            padding-left: 0px;
        }

        #single .detail li {
            width: 10%;
            padding-left: 10px;
            display: table-cell;
        }
        li {
            list-style: none;
        }
        #single .detail li a {
            color: #533d2a;
        }

        #single .detail li a {
            background: #fff;
            padding: 16px 0;
            line-height: 1;
        }
        #single .detail li a i {
            font-size: 26px;
        }
        div.description {
            float: right;
            width: 45%;
            margin: 0px 0px 10px 15px;
        }

        div.description figure {
            text-align: center;
        }

        div.description figure img, ul.tellerlist_contents li figure img, div.favo_teller figure img {
            border: 2px solid #533d2a;
        }

        div.description figure img {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
    </style>
@endsection

@section('content')
    <main>
        <div id="single">
            <div class="info">
                <div class="from center">
                    @if($question->type == 'character_sent')
                        <p>差出人：<span>{{$question->name}}</span></p>
                        <p class="{{$question->reply == 1 ? 'd-none' : '' }}"><a href="#reply"><i class="icon-reply"></i>返信する</a></p>
                    @else
                        <p><span>[鑑定依頼]</span></p>
                        <p class="d-none"><a href="#reply"><i class="icon-reply"></i>返信する</a></p>
                    @endif
                </div>
                <div class="flex date center">
                    <div>{{$question->receive_date}}</div>
                </div>
            </div>
            <div class="content">
                <div class="title flex center {{$question->type !== 'character_sent' ? 'd-none' : '' }}">
                    <p>{{$question->name}}様の ご連絡です</p>

                </div>
                <div class="description">
                    @if(!empty($question->image_url))
                        <figure><img src="{{$question->image_url}}" alt=""></figure>
                    @endif

                </div>
                <p style="white-space: pre-line">
                    {{$question->content}}
                </p>
            </div>
            <div id="reply" class="{{$question->reply == 1 || $question->type !== 'character_sent' ? 'd-none' : '' }}">
                <h1 class="top">このメールに返信する</h1>
                <div class="photo">
                    <a onclick="openFile()">
                        <i class="icon-camera"></i>写真を添付して返信する</a>
                </div>
                <div class="form">
                    <form action="{{url('/teacher-confirm')}}" method="POST" enctype="multipart/form-data">
                        @csrf
{{--                        <div class="count_wrap"><span class="count">0</span>文字</div>--}}
                        @if($errors)
                            <p class="err_msg text-center text-red">{{$errors->first()}}</p>
                        @endif
                        <textarea name="question_content" placeholder="こちらにご記入ください。（全角1000文字以内）"></textarea><br>
                        <div class="preview" style="margin: 20px;">
                            <img id="photo-preview" src="" alt="no_img" style=" width: 100px">
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                        </div>
                        <input type="hidden" name="character_id" value="{{$question->character_id}}">
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                        <input type="submit" name="submit" value="入力内容を確認する" style="opacity: 1;"></form>
                    <p>
                        ※写真を添付したい場合は、「写真を添付」ボタンより、メールに写真を添付し、そのまま送信してください。折り返し、確認メールが届きますので、そちらよりご相談内容をご入力下さい。<br>
                        ※1回のご相談で複数の写真を添付することはできません。
                    </p>
                </div>
                <div class="detail {{$question->type !== 'character_sent' ? 'd-none' : '' }}">
                    <h1 class="top">{{$question->name}}</h1>
                    <ul class="flex stretch">
                        <li>
                            <a href="{{url('/teacher-chat/'.$question->character_id)}}"><i
                                    class="icon-user"></i><span>プロフィール</span></a></li>
                        <li><a href="{{url('/mail-list')}}"><i
                                    class="icon-history"></i><span>送受信履歴</span></a></li>
                        <li class="d-none">
                            <a href="/fortune/regFavorite.php?gid=1&amp;tid=101&amp;p=1&amp;bu=4&amp;mail=288050719.1.1.&amp;type=a&amp;pp=38w7i4hv8cspn5jw"><i
                                    class="icon-book"></i><span>MY鑑定師追加</span></a></li>
                    </ul>
                </div>
                <div class="detail {{$question->type == 'character_sent' ? 'd-none' : '' }}">
                    <ul class="flex stretch">
                        <li><a href="{{url('/mail-list')}}"><i
                                    class="icon-history"></i><span>送受信履歴</span></a></li>
                        <li class="d-none">
                            <a href="/fortune/regFavorite.php?gid=1&amp;tid=101&amp;p=1&amp;bu=4&amp;mail=288050719.1.1.&amp;type=a&amp;pp=38w7i4hv8cspn5jw"><i
                                    class="icon-book"></i><span>MY鑑定師追加</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
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
            $('.preview').hide();
            $('[name="textarea-mBody"]').change(function () {
                var txt = $(this).val()
                console.log(txt.length);
                $(this).prev().prev().find('span.count').text(txt.length);
            })
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
