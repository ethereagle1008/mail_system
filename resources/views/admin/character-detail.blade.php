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
        p {
            color: #564f4e;
            line-height: 135%;
            letter-spacing: -0.01em;
            text-align: justify;
            text-justify: distribute-all-lines;
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
            <h4 class="page-title">キャラ検索</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">キャラ検索</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body p-6">
                        <div class="panel panel-primary">
                            <div class="tab_wrapper first_tab">
                                <ul class="tab_list">
                                    <li class="active">プロファイル</li>
                                    <li>メール履歴</li>
                                    <li>メール送信</li>
                                </ul>

                                <div class="content_wrapper">
                                    <div class="tab_content active">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row mb-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">プロフ画像</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="preview" id="character_img" style="margin: 20px; display: block !important;" >
                                                            <img alt="no_img" class="photo-preview height-1 mx-auto" src="{{isset($character->image) ? $character->image : asset('img/user.jpeg')}}">
                                                            <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                                                        </div>

                                                        <a class="add_img mx-3 btn_base btn_short action deco action_camera" style="cursor: pointer; border: 1px solid">写真を添付</a>
                                                        <input type="file" class="d-none" id="photo_character" name="photo" accept="image/*">
                                                        {{--                                                        <img class="height-1 mx-auto" src="{{$character->image}}">--}}
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">メンバーID</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-left" style="color: greenyellow">{{$character->unique_id}}</p>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">名前</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="name" placeholder="名前" value="{{$character->name}}">
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">キャラボックス</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <select name="box_id" class="form-control custom-select">
                                                            <option></option>
                                                            @foreach($boxes as $box)
                                                                <option value="{{$box->id}}" {{$box->id == $character->box_id ? 'selected' : ''}}>{{$box->box_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">性別</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <select name="gender" class="form-control custom-select">
                                                            <option value="0" {{$character['gender'] == '0' ? 'selected':''}}>男性</option>
                                                            <option value="1" {{$character['gender'] == '1' ? 'selected':''}}>女性</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">生年月日</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="wd-200 mg-b-30">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                                    </div>
                                                                </div><input id="birthday" class="form-control fc-datepicker" name="birthday" placeholder="MM/DD/YYYY" value="{{$character->birth}}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    {{--                                                    <form action="{{url('/manage/character-point')}}" method="post" class="d-flex" style="width: 100%;">--}}
                                                    {{--                                                        @csrf--}}
                                                    <input type="hidden" value="{{$character->id}}" name="character_id">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">減算ポイント</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="number" min="0" max="150" class="form-control" name="decreasing_point" placeholder="名前" value="{{$character->decreasing_point}}" required>
                                                    </div>
                                                    <div class="col-3 d-flex">
                                                        <button type="submit" class="btn btn-primary mr-auto d-none">減算ポイント変更</button>
                                                    </div>
                                                    {{--                                                    </form>--}}

                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">メッセージ </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <textarea type="text" class="form-control" name="message" rows="20" placeholder="" style="width: 200%">{{$character->description}}</textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <input type="submit" value=" 更新 " id="modify_character" class="btn btn-primary mr-auto" style="cursor: pointer">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content">
                                        <div class="row">
                                            <div class="col-2">
                                                <img class="height-1 mx-auto" src="{{isset($character->image) ? $character->image : asset('img/user.jpeg')}}">
                                            </div>
                                            <div class="col-2">
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">メンバーID</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">名前(性別)</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">年齢(生年月日)</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">登録日時</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">減算ポイント</p>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">
                                                        {{$character->unique_id}}
                                                    </p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">{{$character->name}}({{$character == '0' ? '男性' : '女性'}})</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">{{$character->age}}({{$character->birth}})</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">{{$character->created_at}}</p>
                                                </div>
                                                <div class="row d-flex my-1">
                                                    <p class="text-center">{{$character->decreasing_point}}pt</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <p>メール履歴</p>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                                                        <thead  class="bg-primary text-white">
                                                        <tr >
                                                            <th class="text-white" width="20%">ユーザー</th>
                                                            <th class="text-white" width="55%">内容</th>
                                                            <th class="text-white" width="20%">やりとりイメージ</th>
                                                            <th class="text-white" width="5%">修正</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($questions as $question)
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <img src="{{isset($question->image) ? $question->image : asset('img/user.jpeg')}}" style="width: 100px !important;">
                                                                        </div>
                                                                        <div class="col-12 text-center">
                                                                            {{--                                                                            <label>{{$question->name}}</label>--}}
                                                                            <a href="{{url('/manage/member-detail/'.$question->user_id)}}">{{$question->name}}</a>
                                                                        </div>
                                                                        <div class="col-12 text-center">
                                                                            <label>最終ログイン時間:<br>{{$question->last_login}}</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><p>{{$question->receive_date}}
                                                                        @if(date('Y-m-d H:i:s', strtotime($question->receive_date)) > date('Y-m-d H:i:s'))
                                                                            予約
                                                                        @else
                                                                            @if($question->type == 'user_sent')受信@else送信@endif</p>
                                                                    @endif
                                                                    <p style="white-space: pre-line;">{{$question->content}}</p>
                                                                    @if($question->type == 'character_sent')
                                                                        <div class="modify_area" style="display: none;">
                                                                            <textarea style="width: 100%;" rows="10" name="content" required>{{$question->content}}</textarea>
                                                                            <input type="hidden" name="question_id" value="{{$question->question_id}}">
                                                                            <button href="" class="modify_btn">修正</button>
                                                                        </div>
                                                                    @endif

                                                                </td>

                                                                <td scope="row">@if(isset($question->image_url))<img src="{{$question->image_url}}" style="width: 100px !important;">@endif</td>
                                                                <td>
                                                                    @if($question->type == 'character_sent')
                                                                        <a class="modify">修正</a>
                                                                    @else
                                                                        <p>送受信完了</p>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="float-right">
                                                        {!! $questions->appends($pagination_params)->render() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 d-none">
                                                <div class="row mb-3">
                                                    <p>メール統計</p>
                                                </div>
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table card-table table-vcenter text-nowrap table-primary" >
                                                            <thead  class="bg-primary text-white">
                                                            <tr >
                                                                <th class="text-white">イメージ</th>
                                                                <th class="text-white">内容</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Joan Powell</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>Gavin Gibson</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Julian Kerr</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">4</th>
                                                                <td>Cedric Kelly</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5</th>
                                                                <td>Samantha May</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab_content">
                                        {{--                                        <form action="{{url('/manage/user-send')}}" method="POST" class="mx-3" enctype="multipart/form-data">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            <div class="row">--}}
                                        {{--                                                <div class="col-4">--}}
                                        {{--                                                    <div class="form-group">--}}
                                        {{--                                                        <label class="form-label">受信者選択</label>--}}
                                        {{--                                                        <select name="user_id" class="form-control custom-select" required>--}}
                                        {{--                                                            <option value="" selected></option>--}}
                                        {{--                                                            @foreach($users as $user)--}}
                                        {{--                                                                <option value="{{$user->id}}">{{$user->name}}</option>--}}
                                        {{--                                                            @endforeach--}}
                                        {{--                                                        </select>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="row">--}}
                                        {{--                                                <div class="col-9">--}}
                                        {{--                                                    <div class="count_wrap"><span class="count">送信内容</span></div>--}}
                                        {{--                                                    @if($errors)--}}
                                        {{--                                                        <p class="err_msg text-center text-red">{{$errors->first()}}</p>--}}
                                        {{--                                                    @endif--}}
                                        {{--                                                    <textarea class="form_area" name="question_content" rows="10" required style="width: 100%"--}}
                                        {{--                                                              placeholder="※全角1,000文字以内でご入力ください。"></textarea>--}}

                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="row my-3">--}}
                                        {{--                                                <div class="col-9">--}}
                                        {{--                                                    <div class="preview" style="margin: 20px;">--}}
                                        {{--                                                        <img id="photo-preview" src="" alt="no_img" style=" width: 100px">--}}
                                        {{--                                                        <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <input type="hidden" name="character_id" value="{{$character->id}}">--}}

                                        {{--                                                    <a class="mx-3 btn_base btn_short action deco action_camera" onclick="openFile()">写真を添付</a>--}}
                                        {{--                                                    <input type="file" class="d-none" id="photo" name="photo" accept="image/*">--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="row">--}}
                                        {{--                                                <div class="col-9">--}}
                                        {{--                                                    <input type="submit" value=" 送信 " class="btn_base btn_half forward_siteclr">--}}
                                        {{--                                                </div>--}}

                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                                                        <thead  class="bg-primary text-white">
                                                        <tr >
                                                            <th class="text-white" width="20%">ユーザー</th>
                                                            <th class="text-white" width="15%">ユーザーメモ</th>
                                                            <th class="text-white" width="40%">内容</th>
                                                            <th class="text-white" width="25%">送信</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($messages as $question)
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <img src="{{isset($question->image) ? $question->image : asset('img/user.jpeg')}}" style="width: 100px !important;">
                                                                        </div>
                                                                        <div class="col-12 text-center">
                                                                            <a href="{{url('/manage/member-detail/'.$question->user_id)}}">{{$question->name}}</a>
                                                                        </div>
                                                                        <div class="col-12 text-center">
                                                                            <label>最終ログイン時間:<br>{{$question->last_login}}<br>
                                                                                課金回数: {{$question->pay_cnt}}<br>
                                                                                課金金額: {{$question->pay}}<br>
                                                                                登録日時: {{$question->email_verified_at}}<br>
                                                                                保有ポイント: {{$question->point}}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p style="white-space: pre-line;">{{$question->memo}}</p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($question->image_url))
                                                                        <div class="description">
                                                                            <figure><img src="{{$question->image_url}}" alt=""></figure>
                                                                        </div>
                                                                    @endif
                                                                    <p>{{$question->receive_date}}@if($question->type == 'user_sent')受信@else送信@endif</p>
                                                                    <p style="white-space: pre-line;">{{$question->content}}</p></td>

                                                                <td scope="row">
                                                                    {{--                                                                    <form action="{{url('/manage/user-send')}}" method="POST" class="mx-3" enctype="multipart/form-data">--}}
                                                                    @csrf
                                                                    <input type="hidden" name="user_id" value="{{$question->user_id}}">
                                                                    <input type="hidden" name="question_id" value="{{$question->question_id}}">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group ">
                                                                                <div class="form-label">送信日時</div>
                                                                                <div class="custom-controls-stacked d-flex">
                                                                                    <label class="custom-control custom-radio mr-4">
                                                                                        <input type="radio" class="custom-control-input" name="type_{{$question->question_id}}" value="0" checked>
                                                                                        <span class="custom-control-label">今すぐ</span>
                                                                                    </label>
                                                                                    <label class="custom-control custom-radio d-flex">
                                                                                        <input type="radio" class="custom-control-input" name="type_{{$question->question_id}}" value="1">
                                                                                        <span class="custom-control-label">予約</span>
                                                                                        <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                                                                            <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                                                                            <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                                                                            <script>
                                                                                                $(function(){
                                                                                                    $('input[name="send_time"]').datetimepicker({
                                                                                                        minDate: 0,
                                                                                                        lang: 'ja',
                                                                                                        step: 1,		// Step time(minute)
                                                                                                        format:	'Y-m-d H:i:00',
                                                                                                        closeOnDateSelect:false,
                                                                                                        allowBlank: true,
                                                                                                        timepicker: true, // 時間表示
                                                                                                        defaultTime: new Date(new Date().getTime() + 150*1000/*+150ms*/), // 現在時刻からStepTimeの半分を指定（四捨五入され最寄りの5分後がデフォルト表示となる）
                                                                                                        onShow: function(time, self){
                                                                                                            $('input[type=radio]', self.closest('label')).prop('checked', 'checked');
                                                                                                        }
                                                                                                    });
                                                                                                });
                                                                                            </script>
                                                                                            <input type="datetime" class="datetimepicker input-sm form-control" name="send_time" id="send_time">
                                                                                        </div>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="count_wrap"><span class="count">送信内容</span></div>
                                                                            <div class="form-group d-flex mb-0">
                                                                                <div class="mr-1">
                                                                                    <label id="btn_name" class="btn btn-primary mr-auto btn_name">NAME</label>
                                                                                </div>
                                                                                <div class="mx-1">
                                                                                    <label id="btn_mail" class="btn btn-primary mr-auto btn_mail">MAIL</label>
                                                                                </div>
                                                                                <div class="mx-1">
                                                                                    <label id="btn_phone" class="btn btn-primary mr-auto btn_phone">PHONE</label>
                                                                                </div>
                                                                                <div class="mx-1">
                                                                                    <label id="btn_age" class="btn btn-primary mr-auto btn_age">AGE</label>
                                                                                </div>
                                                                                <div class="mx-1">
                                                                                    <label id="btn_birth" class="btn btn-primary mr-auto btn_birth">BIRTH</label>
                                                                                </div>
                                                                                <div class="mx-1">
                                                                                    <label id="btn_area" class="btn btn-primary mr-auto btn_area">PREF</label>
                                                                                </div>
                                                                                <div class="ml-1">
                                                                                    <label id="btn_gender" class="btn btn-primary mr-auto btn_gender">SEX</label>
                                                                                </div>
                                                                            </div>
                                                                            <textarea class="form_area" name="question_content" rows="10" required style="width: 100%"
                                                                                      placeholder="※全角1,000文字以内でご入力ください。"></textarea>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row my-3">
                                                                        <div class="col-12">
                                                                            <div class="preview" style="margin: 20px;">
                                                                                <img class="photo-preview" src="" alt="no_img" style=" width: 100px">
                                                                                <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                                                                            </div>
                                                                            <input type="hidden" name="character_id" value="{{$character->id}}">

                                                                            <a class="add_img mx-3 btn_base btn_short action deco action_camera" style="cursor: pointer; border: 1px solid">写真を添付</a>
                                                                            <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-9">
                                                                            <input type="submit" value=" 送信 " class="btn_submit btn_base btn_half forward_siteclr" style="cursor: pointer">
                                                                        </div>

                                                                    </div>
                                                                    {{--                                                                    </form>--}}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" id="home_path" value="<?=url('');?>">
@endsection
@section('page-js')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script>
        $(document).ready(function () {


        })
        $(".preview").each(function() {
            if($(this)[0].id !== 'character_img'){
                $(this).hide();
            }
        });

        $('.btn_name').click(function () {
            console.log($(this).parent().parent().next().val());
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%username%';
            $(this).parent().parent().next().val(a_txt);
        })
        $('.btn_mail').click(function () {
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%usermail%';
            $(this).parent().parent().next().val(a_txt);
        })
        $('.btn_phone').click(function () {
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%userphone%';
            $(this).parent().parent().next().val(a_txt);
        })
        $('.btn_age').click(function () {
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%userage%';
            $(this).parent().parent().next().val(a_txt);
        })
        $('.btn_birth').click(function () {
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%userbirth%';
            $(this).parent().parent().next().val(a_txt);
        })
        $('.btn_area').click(function () {
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%userpref%';
            $(this).parent().parent().next().val(a_txt);
        })
        $('.btn_gender').click(function () {
            var o_txt = $(this).parent().parent().next().val();
            var a_txt = o_txt + '%usersex%';
            $(this).parent().parent().next().val(a_txt);
        })

        var character_img

        var home_path = $("#home_path").val();

        $('.add_img').click(function () {
            $(this).next().trigger('click');
        })
        function openFile() {
            $('#photo').trigger('click');
        }
        $("[name=photo]").on("change", function(){
            var t = $(this);
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    t.parent().find('.photo-preview')[0].src = e.target.result;
                    t.parent().find('.preview').show();
                    console.log( t.parent().find('.photo-preview'));
                }
                reader.readAsDataURL(this.files[0]);
            }
        })

        $('#character_img').on('change', function () {
            if (this.files && this.files[0]) {
                character_img = this.files[0];
                console.log(character_img);
            }
        })

        $('.btn_submit').click(function () {
            var token = $("meta[name='_csrf']").attr("content");
            var user_id = $(this).parent().parent().parent().find('input[name=user_id]').val();
            var question_id = $(this).parent().parent().parent().find('input[name=question_id]').val();
            var character_id = $(this).parent().parent().parent().find('input[name=character_id]').val();
            var type = $(this).parent().parent().parent().find('input:radio:checked').val();
            var send_time = $(this).parent().parent().parent().find('input[name=send_time]').val();
            var question_content = $(this).parent().parent().parent().find('[name=question_content]').val();
            var photo = $(this).parent().parent().parent().find('input[name=photo]')[0].files[0];

            if(type == '' || type == undefined) return;
            if(type==1 && send_time == '') return;
            if(question_content == '') return;
            var formData = new FormData();
            formData.append('user_id', user_id);
            formData.append('question_id', question_id);
            formData.append('character_id', character_id);
            formData.append('type', type);
            formData.append('send_time', send_time);
            formData.append('question_content', question_content);
            formData.append('photo', photo);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            var url = home_path + '/manage/user-send';
            $.ajax({
                url:url,
                type:'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "送信成功",
                        duration: 3000
                    });
                    window.location.reload();
                },
                error: function () {
                    $.growl.warning({
                        title: "警告",
                        message: "送信失敗",
                        duration: 3000
                    });
                    return false;
                }
            });
        })

        $('#modify_character').click(function () {
            var token = $("meta[name='_csrf']").attr("content");
            var name = $(this).parent().parent().prev().find('input[name=name]').val();
            var box_id = $(this).parent().parent().prev().find('[name=box_id]').val();
            var gender = $(this).parent().parent().prev().find('[name=gender]').val();

            var character_id = $(this).parent().parent().prev().find('input[name=character_id]').val();
            var birthday = $(this).parent().parent().prev().find('input[name=birthday]').val();
            var decreasing_point = $(this).parent().parent().prev().find('input[name=decreasing_point]').val();
            var message = $(this).parent().parent().prev().find('[name=message]').val();
            var photo = $(this).parent().parent().prev().find('[name=photo]')[0].files[0];

            if(name == '') return;
            if(birthday=='1') return;
            if(decreasing_point == '') return;
            var formData = new FormData();
            formData.append('name', name);
            formData.append('box_id', box_id);
            formData.append('gender', gender);
            formData.append('character_id', character_id);
            formData.append('birthday', birthday);
            formData.append('decreasing_point', decreasing_point);
            formData.append('message', message);
            formData.append('photo', photo);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            var url = home_path + '/manage/modify-character';
            $.ajax({
                url:url,
                type:'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "更新成功",
                        duration: 3000
                    });

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

            var url = home_path + '/manage/question-modify';
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
            $(this).parent().prev().prev().find('.modify_area').show();
        })

        $('.btn-danger').click(function () {
            $(this).parent().hide();
            $(this).parent().find('.photo-preview')[0].src = '';
            $(this).parent().parent().find('[name=photo]').val('');

        })
        function deleteImg() {
            // $('.preview').hide();
            // $('#photo-preview').attr('src',"");
            // $('#photo').val('');
        }
        $(function(e) {
            $(".first_tab").champ();
            $(".accordion_example").champ({
                plugin_type: "accordion",
                side: "left",
                active_tab: "3",
                controllers: "true"
            });

            $(".second_tab").champ({
                plugin_type: "tab",
                side: "right",
                active_tab: "1",
                controllers: "false"
            });
        });
    </script>

@endsection
