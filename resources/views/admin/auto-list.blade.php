@extends('admin.layout.base')

@section('page-css')
    <style>
        div.description {
            float: right;
            width: 25%;
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

        img {
            vertical-align: middle;
        }

        .modify_btn{
            background: white;
            padding: 5px;
            border-radius: 6px;
            border: 1px solid;
            display: flex;
            width: fit-content;
            float: right;
            cursor: pointer;
        }

        .modify{
            cursor: pointer;
        }
    </style>

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">予約メッセージ</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">予約メッセージ</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-header">
                    <h3 class="card-title">予約メッセージの一覧</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                        <thead class="bg-primary text-white">
                        <tr >
                            <th class="text-white" width="15%">送信日時</th>
                            <th class="text-white" width="10%">キャラ</th>
                            <th class="text-white" width="40%">送信条件</th>
                            <th class="text-white" width="30%">本文</th>
                            <th class="text-white" width="5%">修正</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{$message->send_time}}</td>
                                <th><a href="{{url('/manage/character-detail/'.$message->character_id)}}">{{$message->name}}</a></th>
                                <td>
                                    @if(!empty($message->unique_id))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">メンバーID:{{$message->unique_id}}</p>@endif
                                    @if(!empty($message->user_name))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">名称:{{$message->user_name}}</p>@endif
                                    @if(!empty($message->gender))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">性別:{{$message->gender == 0 ? '男性':'女性'}}</p>@endif
                                    @if(!empty($message->start_age) || !empty($message->end_age))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">年齢:{{!empty($message->start_age) ? $message->start_age.'歳': ''}}~{{!empty($message->end_age) ? $message->end_age.'歳': ''}}</p>@endif
                                    @if(!empty($message->start_count) || !empty($message->end_count))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">入金回数:{{!empty($message->start_count) ? $message->start_count.'回': ''}}~{{!empty($message->end_count) ? $message->end_count.'回': ''}}</p>@endif
                                    @if(!empty($message->start_point) || !empty($message->end_point))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">残りポイント:{{!empty($message->start_point) ? $message->start_point.'P': ''}}~{{!empty($message->end_point) ? $message->end_point.'P': ''}}</p>@endif
                                    @if(!empty($message->start_price) || !empty($message->end_price))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">課金額:{{!empty($message->start_price) ? $message->start_price.'円': ''}}~{{!empty($message->end_price) ? $message->end_price.'円': ''}}</p>@endif
                                    @if(!empty($message->start_login) || !empty($message->end_login))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px; white-space: pre-line;">最終ログイン日時:{{$message->start_login}}~{{$message->end_login}}</p>@endif
                                    @if(!empty($message->start_money) || !empty($message->end_money))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">最終入金日:{{$message->start_money}}~{{$message->end_money}}</p>@endif
                                </td>
                                <td> <p style="white-space: pre-line;">{{$message->content}}</p>
                                    @if(isset($message->image))
                                        <div class="description">
                                            <figure><img src="{{$message->image}}" alt=""></figure>
                                        </div>
                                    @endif
                                    @if($message->status == 1)
                                        <div class="modify_area" style="display: none;">
                                            <textarea style="width: 100%;" rows="10" name="content" required>{{$message->content}}</textarea>
                                            <input type="hidden" name="question_id" value="{{$message->id}}">
                                            <button href="" class="modify_btn">修正</button>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($message->status == 1)
                                        <a class="modify">修正/</a><a href="{{url('/manage/auto-delete/'.$message->id)}}" name="delete" value="3">削除</a>
                                    @else
                                        <p>送信完了</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {!! $messages->appends($pagination_params)->render() !!}
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">

                    <!-- table-responsive -->
                </div>
            </div>
        </div>

    </div>
@endsection
@section('page-js')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script type="text/javascript">
        $('.preview').hide();
        var home_path = $("#home_path").val();
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
        $('.modify_btn').click(function () {
            var token = $("meta[name='_csrf']").attr("content");
            var content = $(this).prev().prev().val();
            console.log(content);
            if(content == '') return;

            //return false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/auto-modify';
            $.ajax({
                url:url,
                type:'post',
                data: {
                    question_id : $(this).prev().val(),
                    q_content : content
                },
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "更新成功",
                        duration: 3000
                    });
                    window.location.reload();

                },
                error: function () {
                    $.growl.warning({
                        title: "警告",
                        message: "更新失敗",
                        duration: 3000
                    });
                    return false;
                }
            });
        })

        $('.modify').click(function () {
            $(this).parent().prev().find('.modify_area').show();
        })
        function deleteImg() {
            $('.preview').hide();
            $('#photo-preview').attr('src',"");
            $('#photo').val('');
        }

        $(document).ready(function() {
            $('[name=type]').change(function () {
                console.log($(this).val());
                if($(this).val() === 1){
                    $('[name=send_time]').prop('required',true);
                }
                else{
                    $('[name=send_time]').val('');
                    $('[name=send_time]').prop('required',false);
                }
            })
            var characters = JSON.parse($('#characters').val());


            $('[name="character_id"]').change(function () {
                for(var i = 0; i < characters.length; i++){
                    if(characters[i]['id'] == $(this).val()){
                        $('[name=name]').val(characters[i]['name']);
                        $('[name=gender]').val(characters[i]['gender']);
                        $('[name=birthday]').val(characters[i]['birth']);
                        $('[name=decreasing_point]').val(characters[i]['decreasing_point']);
                        $('[name=description]').val(characters[i]['description']);
                        $('[name=image]')[0].src = characters[i]['image'];
                    }
                }
            })
        });
    </script>

@endsection
