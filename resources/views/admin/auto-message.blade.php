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
    </style>
@endsection

@section('content')
    <input type="hidden" value="{{json_encode($characters)}}" id="characters">
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">同報メンバー</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">同報メンバー</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{url('/manage/auto-message')}}" id="auto" method="post" class="card" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">送信内容と方式</h3>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group ">
                                    <div class="form-label">送信日時</div>
                                    <div class="custom-controls-stacked d-flex">
                                        <label class="custom-control custom-radio mr-4">
                                            <input type="radio" class="custom-control-input" name="type" value="0" checked="">
                                            <span class="custom-control-label">今すぐ</span>
                                        </label>
                                        <label class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="type" value="1">
                                            <span class="custom-control-label">予約</span>
                                            <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                                <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                                <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                                <script>
                                                    $(function(){
                                                        $('input[name="send_time"]').datetimepicker({
                                                            minDate: 0,
                                                            lang: 'ja',
                                                            step: 5,		// Step time(minute)
                                                            format:	'Y-m-d H:i',
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
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">送信内容</label>
                                    <div class="form-group d-flex mb-0">
                                        <div class="mr-1">
                                            <label id="btn_name" class="btn btn-primary mr-auto">NAME</label>
                                        </div>
                                        <div class="mx-1">
                                            <label id="btn_mail" class="btn btn-primary mr-auto">MAIL</label>
                                        </div>
                                        <div class="mx-1">
                                            <label id="btn_phone" class="btn btn-primary mr-auto">PHONE</label>
                                        </div>
                                        <div class="mx-1">
                                            <label id="btn_age" class="btn btn-primary mr-auto">AGE</label>
                                        </div>
                                        <div class="mx-1">
                                            <label id="btn_birth" class="btn btn-primary mr-auto">BIRTH</label>
                                        </div>
                                        <div class="mx-1">
                                            <label id="btn_area" class="btn btn-primary mr-auto">PREF</label>
                                        </div>
                                        <div class="ml-1">
                                            <label id="btn_gender" class="btn btn-primary mr-auto">SEX</label>
                                        </div>
                                    </div>
                                    <div class="row gutters-xs">
                                        <div class="col-12">
                                           <textarea id="message_text" class="form_area" name="question_content" rows="10" required style="width: 100%"
                                                     placeholder="※全角1,000文字以内でご入力ください。"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-label">画像</label>
                                    <div class="preview" style="margin: 20px;">
                                        <img id="photo-preview" src="" alt="no_img" style=" width: 100px">
                                        <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                                    </div>

                                    <a class="mx-3 btn_base btn_short action deco action_camera" onclick="openFile()" style="cursor: pointer; border: 1px solid">写真を添付</a>
                                    <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-header">
                        <h3 class="card-title">送信キャラ選択</h3>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">キャラ選択</label>
                                    <select name="character_id" class="form-control custom-select" required>
                                        <option value="" selected></option>
                                        @for($i = 0; $i < count($characters); $i++)
                                            <option value="{{$characters[$i]['id']}}">{{$characters[$i]['unique_id']}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">名称</label>
                                    <input type="text" class="form-control" name="name" placeholder="名称">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">生年月日</label>
                                    <div class="row gutters-xs">
                                        <div class="col-12">
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div><input id="birthday" class="form-control fc-datepicker" name="birthday" placeholder="MM/DD/YYYY" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">削減ポイント</label>
                                    <input type="number" class="form-control" name="decreasing_point" placeholder="削減ポイント">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">プロファイル画像</label>
                                    {{--                                    <div class="preview" style="margin: 20px;">--}}
                                    {{--                                        <img id="photo-preview" src="" alt="no_img" style=" width: 100px">--}}
                                    {{--                                    </div>--}}
                                    <div class="d-flex" id="profile_img" style="width: 100px;">
                                        <img class="" name="image" src="{{asset('img/org.jpg')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group" style="width: 50% !important;">
                                    <label class="form-label">性別</label>
                                    <select name="" id="gender" class="form-control custom-select">
                                        <option value="0">男性</option>
                                        <option value="1">女性</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">メッセージ *</label>
                                    <textarea class="form-control" name="description" rows="12" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">送信先条件</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">メンバーID</label>
                                    <input type="number" class="form-control" name="unique_id" placeholder="メンバーID" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">名称</label>
                                    <input type="text" class="form-control" name="user_name" placeholder="名称" value="">
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">性別</label>
                                    <select name="gender" class="form-control custom-select">
                                        <option value=""></option>
                                        <option value="0">男性</option>
                                        <option value="1">女性</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">年齢</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" id="start_age" class="form-control" name="start_age" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_age" class="form-label mt-2">歳~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" id="end_age" class="form-control" name="end_age" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_age" class="form-label mt-2">歳</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">入金回数</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" id="start_count" class="form-control" name="start_count" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_count" class="form-label mt-2">回~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" id="end_count" class="form-control" name="end_count" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_count" class="form-label mt-2">回</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">課金額</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" id="start_money" class="form-control" name="start_price" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_money" class="form-label mt-2">円~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" id="end_money" class="form-control" name="end_price" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_money" class="form-label mt-2">円</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">最終入金日</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                                <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                                <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                                <script>
                                                    $(function(){
                                                        $('input[type=datetime]').datetimepicker({
                                                            lang: 'ja',
                                                            step: 5,		// Step time(minute)
                                                            format:	'Y-m-d H:i',
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
                                                <input type="datetime" class="datetimepicker input-sm form-control " name="start_money" value="">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <label for="start_last_money_day" class="form-label mt-2">~</label>
                                        </div>
                                        <div class="col-4">
                                            <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                                <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                                <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                                <script>
                                                    $(function(){
                                                        $('input[type=datetime]').datetimepicker({
                                                            lang: 'ja',
                                                            step: 5,		// Step time(minute)
                                                            format:	'Y-m-d H:i',
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
                                                <input type="datetime" class="datetimepicker input-sm form-control " name="end_money" value="">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label for="end_last_money_day" class="form-label mt-2"></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">残りポイント</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" id="start_point" class="form-control" name="start_point" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_point" class="form-label mt-2">P~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" id="end_point" class="form-control" name="end_point" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_point" class="form-label mt-2">P</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">最終ログイン日時</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                                <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                                <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                                <script>
                                                    $(function(){
                                                        $('input[type=datetime]').datetimepicker({
                                                            lang: 'ja',
                                                            step: 5,		// Step time(minute)
                                                            format:	'Y-m-d H:i',
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
                                                <input type="datetime" class="datetimepicker input-sm form-control " name="start_login" value="">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <label for="start_last_login_day" class="form-label mt-2">~</label>
                                        </div>
                                        <div class="col-4">
                                            <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                                <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                                <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                                <script>
                                                    $(function(){
                                                        $('input[type=datetime]').datetimepicker({
                                                            lang: 'ja',
                                                            step: 5,		// Step time(minute)
                                                            format:	'Y-m-d H:i',
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
                                                <input type="datetime" class="datetimepicker input-sm form-control " name="end_login" value="">
                                            </div>

                                        </div>
                                        <div class="col-2">
                                            <label for="end_last_login_day" class="form-label mt-2"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <div class="d-flex mt-3 pt-3">
                                        <a class="mt-3 mb-0" id="user_list" style="cursor:pointer" >ユーザー一覧</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div id="select_user">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">メッセージを送信する</button>
                        </div>
                    </div>
                </form>
                <div class="card-header">
                    <h3 class="card-title">送信の一覧</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                        <thead  class="bg-primary text-white">
                        <tr >
                            <th class="text-white" width="10%">送信日時</th>
                            <th class="text-white" width="20%">キャラ</th>
                            <th class="text-white" width="40%">送信条件</th>
                            <th class="text-white" width="30%">本文</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{$message->send_time}}</td>
                                <th scope="row"><a href="{{url('/manage/character-detail/'.$message->character_id)}}">{{$message->name}}</a></th>
                                <td>
                                    @if(!empty($message->unique_id))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">メンバーID:{{$message->unique_id}}</p>@endif
                                        @if(!empty($message->user_name))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">名称:{{$message->user_name}}</p>@endif
                                        @if(!empty($message->gender))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">性別:{{$message->gender == 0 ? '男性':'女性'}}</p>@endif
                                        @if(!empty($message->start_age) || !empty($message->end_age))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">年齢:{{!empty($message->start_age) ? $message->start_age.'歳': ''}}~{{!empty($message->end_age) ? $message->end_age.'歳': ''}}</p>@endif
                                        @if(!empty($message->start_count) || !empty($message->end_count))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">入金回数:{{!empty($message->start_count) ? $message->start_count.'回': ''}}~{{!empty($message->end_count) ? $message->end_count.'回': ''}}</p>@endif
                                        @if(!empty($message->start_point) || !empty($message->end_point))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">残りポイント:{{!empty($message->start_point) ? $message->start_point.'P': ''}}~{{!empty($message->end_point) ? $message->end_point.'P': ''}}</p>@endif
                                        @if(!empty($message->start_price) || !empty($message->end_price))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">課金額:{{!empty($message->start_price) ? $message->start_price.'円': ''}}~{{!empty($message->end_price) ? $message->end_price.'円': ''}}</p>@endif
                                        @if(!empty($message->start_login) || !empty($message->end_login))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">最終ログイン日時:{{$message->start_login}}~{{$message->end_login}}</p>@endif
                                        @if(!empty($message->start_money) || !empty($message->end_money))<p style="border: 1px solid; padding: 2px; width: fit-content; margin-bottom: 2px;">最終入金日:{{$message->start_money}}~{{$message->end_money}}</p>@endif
                                </td>
                                <td>
                                    <p style="white-space: pre-line;">{{$message->content}}</p>
                                    @if(isset($message->image))
                                        <div class="description">
                                            <figure><img src="{{$message->image}}" alt=""></figure>
                                        </div>
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
        <input type="hidden" id="home_path" value="<?=url('');?>">

    </div>
@endsection
@section('page-js')
    <script type="text/javascript">
        $('.preview').hide();
        var home_path = $("#home_path").val();
        $('#btn_name').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%username%';
            $('#message_text').val(a_txt);
        })
        $('#btn_mail').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%usermail%';
            $('#message_text').val(a_txt);
        })
        $('#btn_phone').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%userphone%';
            $('#message_text').val(a_txt);
        })
        $('#btn_age').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%userage%';
            $('#message_text').val(a_txt);
        })
        $('#btn_birth').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%userbirth%';
            $('#message_text').val(a_txt);
        })
        $('#btn_area').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%userpref%';
            $('#message_text').val(a_txt);
        })
        $('#btn_gender').click(function () {
            var o_txt = $('#message_text').val();
            var a_txt = o_txt + '%usersex%';
            $('#message_text').val(a_txt);
        })
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

        $('#user_list').click(function () {
            getUserList();
        })

        function deleteImg() {
            $('.preview').hide();
            $('#photo-preview').attr('src',"");
            $('#photo').val('');
        }

        function getUserList() {
            var token = $("meta[name='_csrf']").attr("content");
            var form = $('#auto')[0]; // You need to use standard javascript object here
            console.log(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/select-users';
            $.ajax({
                url:url,
                type:'post',
                data: {
                    unique_id : $('[name="unique_id"]').val(),
                    user_name : $('[name="user_name"]').val(),
                    gender : $('[name="gender"]').val(),
                    start_age : $('[name="start_age"]').val(),
                    end_age : $('[name="end_age"]').val(),
                    start_count : $('[name="start_count"]').val(),
                    end_count : $('[name="end_count"]').val(),
                    start_money : $('[name="start_money"]').val(),
                    end_money : $('[name="end_money"]').val(),
                    start_price : $('[name="start_price"]').val(),
                    end_price : $('[name="end_price"]').val(),
                    start_point : $('[name="start_point"]').val(),
                    end_point : $('[name="end_point"]').val(),
                    start_login : $('[name="start_login"]').val(),
                    end_login : $('[name="end_login"]').val()
                },
                success: function (response) {
                    $("#select_user").html(response);
                    $('html, body').animate({
                        scrollTop: $("#btn_search").offset().top - $("#top_header").height() - 20
                    });
                },
                error: function () {
                }
            });
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
                        $('#gender').val(characters[i]['gender']);
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
