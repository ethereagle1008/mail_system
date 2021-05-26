@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        #container {
            padding-bottom: 5%;
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

        #container_inner {
            padding: 0 2%;
        }

        #container p {
            margin: 10px 0;
        }

        p.err_msg {
            font-size: 1em;
            margin-top: 15px;
            padding: 0px 3%;
        }

        p {
            color: #564f4e;
            font-size: 1em;
            line-height: 135%;
            letter-spacing: -0.01em;
            text-align: justify;
            text-justify: distribute-all-lines;
        }

        section#form_acc {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            border: 1px solid #cbc9c9;
            background: #f5f3ed;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            text-decoration: none;
            vertical-align: middle;
            padding: 20px 20px 10px;
            width: 100%;
            margin: 0px auto 15px;
        }

        .form_title {
            margin-bottom: 10px;
            font-size: 0.9em;
            font-weight: bold;
            color: #3a6b90;
            text-shadow: #ffffff 0 1px 0;
        }

        .defult_input {
            border: 1px solid #bdbcb9;
            background: #e0dfdc;
            color: #6a859a;
            line-height: 1.5em;
        }

        .form_field, .defult_input {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            font-size: 1em;
            -webkit-box-shadow: rgb(255 255 255 / 40%) 0 1px 0, inset rgb(0 0 0 / 70%) 0 0px 0px;
            -moz-box-shadow: rgba(255, 255, 255, 0.4) 0 1px 0, inset rgba(000, 000, 000, 0.7) 0 0px 0px;
            box-shadow: rgb(255 255 255 / 40%) 0 1px 0, inset rgb(0 0 0 / 70%) 0 0px 0px;
            padding: 5px;
            width: 100%;
            display: block;
        }

        .form_field, .defult_input, ul.sm {
            margin-bottom: 20px;
        }

        .str_clr {
            color: #f32f20;
        }

        .fsz12 {
            font-size: 0.7em;
        }

        .form_field {
            border: 1px solid #c2c2bf;
            background: #f9f9f9;
            color: #96908f;
            margin-top: 7px;
        }

        .defult_select select {
            position: relative;
            width: 100%;
            padding: 8px 30px 8px 8px;
            margin-bottom: 20px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid #bdbcb9;
            background: #fdfcfa;
            font-size: 12px;
            color: #564f4e;
            background: url(img/pulldown_arrow2.png) right 50% no-repeat, -webkit-linear-gradient(top, #fff 0%, #efebe1 100%);
            background: url(img/pulldown_arrow2.png) right 50% no-repeat, linear-gradient(to bottom, #fff 0%, #efebe1 100%);
            background-size: 24px, 100%;
        }

        #container p a:link {
            color: #007aff;
        }

        #container p a {
            display: initial;
        }

        footer a, a:link, a:active, a:visited {
            outline: none;
            text-decoration: none;
        }

        input.btn_normal {
            height: 51px;
            line-height: 45px;
        }

        a.forward, .forward {
            background: #2060a1;
            background: -moz-linear-gradient(top, #2060a1 0%, #2060a1 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2060a1), color-stop(100%, #2060a1));
            background: -webkit-linear-gradient(top, #2060a1 0%, #2060a1 100%);
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
    <main>
        <div id="container">

            <h1 class="official">プロフィールの確認・変更</h1>
            <div id="container_inner">

                <form action="{{url('/modify-profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <p class="err_msg"></p>
                    <section id="form_acc">
                        <div class="form_title">会員ID</div>
                        <div class="defult_input">{{$user->unique_id}}</div>

                        <div class="form_title">ハンドルネーム&nbsp;<span class="str_clr fsz12">∗</span>
                        </div>
                        <input class="form_field" type="text" name="name" placeholder="全角8文字以内でご入力下さい" value="{{$user->name}}" required>
                        <div class="form_title">メールアドレス <span class="str_clr fsz12">∗</span></div>
                        <input class="form_field" type="text" name="email" value="{{$user->email}}">
{{--                        <div class="defult_select">--}}
{{--                            <label style="display: flex;">--}}
{{--                                <input class="form_field" style="margin-top: 0; margin-right: 10px" type="text" name="email_header" value="{{$user->email_header}}" required>--}}
{{--                                <select name="email_type">--}}
{{--                                    <option value="@docomo.ne.jp" {{$user->email_type == '@docomo.ne.jp' ? 'selected' : ''}}>@docomo.ne.jp</option>--}}
{{--                                    <option value="@au.com" {{$user->email_type == '@au.com' ? 'selected' : ''}}>@au.com</option>--}}
{{--                                    <option value="@softbank.ne.jp" {{$user->email_type == '@softbank.ne.jp' ? 'selected' : ''}}>@softbank.ne.jp</option>--}}
{{--                                    <option value="@ezweb.ne.jp" {{$user->email_type == '@ezweb.ne.jp' ? 'selected' : ''}}>@ezweb.ne.jp</option>--}}
{{--                                    <option value="@t.vodafone.ne.jp" {{$user->email_type == '@t.vodafone.ne.jp' ? 'selected' : ''}}>@t.vodafone.ne.jp</option>--}}
{{--                                    <option value="@k.vodafone.ne.jp" {{$user->email_type == '@k.vodafone.ne.jp' ? 'selected' : ''}}>@k.vodafone.ne.jp</option>--}}
{{--                                    <option value="@d.vodafone.ne.jp" {{$user->email_type == '@@d.vodafone.ne.jp' ? 'selected': ''}}>@d.vodafone.ne.jp</option>--}}
{{--                                    <option value="@h.vodafone.ne.jp" {{$user->email_type == '@h.vodafone.ne.jp' ? 'selected' : ''}}>@h.vodafone.ne.jp</option>--}}
{{--                                    <option value="@c.vodafone.ne.jp" {{$user->email_type == '@c.vodafone.ne.jp' ? 'selected' : ''}}>@c.vodafone.ne.jp</option>--}}
{{--                                </select>--}}
{{--                            </label>--}}
{{--                        </div>--}}

                        <!-- ▽携帯メールアドレス(現在未使用)ここから▽

                        △携帯メールアドレス(現在未使用)ここまで△ -->

                        <div class="form_title">性別 <span class="str_clr fsz12">∗</span></div>
                        <div class="defult_select">
                            <label style="width: 100%;">
                                <select name="gender">
                                    <option value="0" {{$user->gender == 0? 'selected' : ''}}>男</option>
                                    <option value="1" {{$user->gender == 1? 'selected' : ''}}>女</option>
                                </select>
                            </label>
                        </div>

                        <div class="form_title">生年月日 <span class="str_clr fsz12">∗</span></div>
                        <input type="text" id="birth" name="birth" class="fc-datepicker form_field" placeholder="YYYY-MM-DD" value="{{$user->birth}}" required>

                        <div class="form_title">身長
                        </div>
                        <input class="form_field" type="text" name="height" value="{{$user->height}}">

                        <div class="form_title">お住まいの地域 <span class="str_clr fsz12">∗</span></div>
                        <input type="text" name="region" class="fc-datepicker form_field" placeholder="お住まいの地域" value="{{$user->region}}" required>
{{--                        <div class="defult_select">--}}
{{--                            <label style="width: 100%">--}}
{{--                                <select name="region">--}}
{{--                                    @foreach($regions as $one)--}}
{{--                                        <option value="{{$one->name}}" {{$user->region == $one->name? 'selected' : ''}}>{{$one->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </label>--}}
{{--                        </div>--}}

                        <div class="col-12 col-md-6 px-0">
                            <div class="form-group">
                                <label class="form-label">プロファイル画像</label>
                                <div class="preview" style="margin: 20px; display: {{!isset($user->image) ? 'none !important;' : 'block !important;'}}">
                                    <img id="photo-preview" alt="no_img" class="" style=" width: 100px" src="{{isset($user->image) ? $user->image : asset('img/user.jpeg')}}">
                                    <label id="img_del" class="btn btn-sm btn-danger" onclick="deleteImg()">削除</label>
                                </div>
                                <button type="button" id="img_add" class="" onclick="openFile()" style="">写真を添付</button>
                                <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                            </div>
                        </div>


{{--                        <div class="form_title">結婚歴&nbsp;<span class="str_clr fsz12">∗</span></div>--}}
{{--                        <ul class="sm cf">--}}
{{--                            <li><input type="radio" name="radio-um" value="t" id="um_t" checked=""><label--}}
{{--                                    for="um_t">既婚</label></li>--}}
{{--                            <li><input type="radio" name="radio-um" value="f" id="um_f"><label for="um_f">未婚</label>--}}
{{--                            </li>--}}
{{--                        </ul>--}}

{{--                        <div class="form_title">通知メール&nbsp;<span class="str_clr fsz12">∗</span></div>--}}
{{--                        <ul class="sm cf">--}}
{{--                            <li><input type="radio" name="radio-nt" value="t" id="nt_t" checked=""><label for="nt_t">受信する</label>--}}
{{--                            </li>--}}
{{--                            <li><input type="radio" name="radio-nt" value="f" id="nt_f"><label for="nt_f">受信しない</label>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <p class="str_clr fsz12">∗入力必須項目</p>
                    </section>

                    <p>※生年月日の変更は<a href="{{'/question'}}">サポート窓口</a>までご連絡ください。
                    </p>
                    <input type="submit" value=" この内容で登録する " id="submit" class="btn_base btn_normal forward">
                </form>
            </div><!--/#container_inner-->

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
    <!-- Core JS files -->
    <script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/vendors/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Date Picker Plugin -->
    <link href="{{asset('plugins/date-picker/spectrum.css')}}" rel="stylesheet" />
    <!-- Datepicker js -->
    <script src="{{ asset('plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            //$('.preview').hide();
            $('#submit').click(function () {
                window.location.reload();

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
