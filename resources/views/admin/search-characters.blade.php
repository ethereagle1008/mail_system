@extends('admin.layout.base')

@section('page-css')

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
            <div class="col-12">
                <form method="post" class="card">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">基本情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">減算設定</label>--}}
{{--                                    <select name="gender" class="form-control custom-select">--}}
{{--                                        <option value="150">150</option>--}}
{{--                                        <option value="180">180</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label class="form-label">キャラID</label>
                                    <input type="text" class="form-control" name="unique_id" placeholder="メンバーID" value="{{$search_param['unique_id']}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">名称</label>
                                    <input type="text" class="form-control" name="name" placeholder="名称" value="{{$search_param['name']}}">
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">位置情報</label>--}}
{{--                                    <select name="position" class="form-control custom-select">--}}
{{--                                        <option value="male">ワイルド</option>--}}
{{--                                        <option value="female">固定</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label class="form-label">性別</label>
                                    <select name="gender" class="form-control custom-select">
                                        <option value="" {{$search_param['gender'] == '' ? 'selected':''}}></option>
                                        <option value="0" {{$search_param['gender'] == '0' ? 'selected':''}}>男性</option>
                                        <option value="1" {{$search_param['gender'] == '1' ? 'selected':''}}>女性</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">年齢</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="text" id="start_age" class="form-control" name="start_age" placeholder="" value="{{$search_param['start_age']}}">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_age" class="form-label mt-2">歳~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_age" class="form-control" name="end_age" placeholder="" value="{{$search_param['end_age']}}">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_age" class="form-label mt-2">歳</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">その他情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">返信回数</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="text" id="start_reply_count" class="form-control" name="start_reply_count" placeholder="" value="{{$search_param['start_reply_count']}}">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_reply_count" class="form-label mt-2">回~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_reply_count" class="form-control" name="end_reply_count" placeholder="" value="{{$search_param['end_reply_count']}}">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_reply_count" class="form-label mt-2">回</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">反応なし回数</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="text" id="start_no_reply" class="form-control" name="start_no_reply" placeholder="" value="{{$search_param['start_no_reply']}}">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_no_reply" class="form-label mt-2">回~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_no_reply" class="form-control" name="end_no_reply" placeholder="" value="{{$search_param['end_no_reply']}}">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_no_reply" class="form-label mt-2">回</label>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">最終入金日</label>--}}
{{--                                    <div class="row gutters-xs">--}}
{{--                                        <div class="col-4">--}}
{{--                                            <div class="wd-200 mg-b-30">--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <div class="input-group-text">--}}
{{--                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div><input id="start_last_money_day" class="form-control fc-datepicker" name="start_last_money_day" placeholder="MM/DD/YYYY" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-2">--}}
{{--                                            <label for="start_last_money_day" class="form-label mt-2">~</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4">--}}
{{--                                            <div class="wd-200 mg-b-30">--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <div class="input-group-prepend">--}}
{{--                                                        <div class="input-group-text">--}}
{{--                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div><input id="end_last_money_day" class="form-control fc-datepicker" name="end_last_money_day" placeholder="MM/DD/YYYY" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <div class="col-2">--}}
{{--                                            <label for="end_last_money_day" class="form-label mt-2"></label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">メッセージ</label>
                                    <input type="text" class="form-control" name="description" placeholder="メッセージ" value="{{$search_param['description']}}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">登録日時</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div><input id="start_last_login_day" class="form-control fc-datepicker" name="start_last_login_day" placeholder="MM/DD/YYYY" type="text" value="{{$search_param['start_last_login_day']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <label for="start_last_login_day" class="form-label mt-2">~</label>
                                        </div>
                                        <div class="col-4">
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div><input id="end_last_login_day" class="form-control fc-datepicker" name="end_last_login_day" placeholder="MM/DD/YYYY" type="text" value="{{$search_param['end_last_login_day']}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-2">
                                            <label for="end_last_login_day" class="form-label mt-2"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">検索開始</button>
                        </div>
                    </div>
                </form>
                <div class="card-header">
                    <h3 class="card-title">キャラ</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                        <thead  class="bg-primary text-white">
                        <tr >
                            <th width="20%" class="text-white">ID</th>
                            <th width="25%" class="text-white">名称</th>
                            <th width="15%" class="text-white">性別</th>
                            <th width="15%" class="text-white">年齢</th>
                            <th width="20%" class="text-white">減算ポイント</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($characters as $character)
                            <tr>
                                <th scope="row"><a href="{{url('/manage/character-detail/'. $character->id)}}">{{$character->unique_id}}</a></th>
                                <td>{{$character->name}}</td>
                                <td>{{$character->gender}}</td>
                                <td>{{$character->age}}歳</td>
                                <td>{{$character->decreasing_point}}pt</td>
                                <td>
                                    <input type="hidden" value="{{$character->id}}">
                                    <button class="member_delete btn btn-primary ml-auto">削除</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {!! $characters->appends($pagination_params)->render() !!}
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
        var home_path = $("#home_path").val();
        $(document).ready(function () {
            $('.member_delete').click(function () {
                var token = $("meta[name='_csrf']").attr("content");
                var character_id = $(this).prev().val();

                //return false;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                var url = home_path + '/manage/character-delete';
                $.ajax({
                    url:url,
                    type:'post',
                    data: {
                        character_id : character_id,
                    },
                    success: function (response) {
                        $.growl.notice({
                            title: "成功",
                            message: "削除成功",
                            duration: 3000
                        });
                        window.location.reload();

                    },
                    error: function () {
                        $.growl.warning({
                            title: "警告",
                            message: "エラーが発生しました。",
                            duration: 3000
                        });
                        return false;
                    }
                });
            })

        })
    </script>

@endsection
