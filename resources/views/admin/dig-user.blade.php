@extends('admin.layout.base')

@section('page-css')
    <style>
        #example_filter{
            display: none;
        }
    </style>


@endsection

@section('content')
    <input type="hidden" value="{{json_encode($characters)}}" id="characters">
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">メンバー掘り起こし</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">メンバー掘り起こし</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" class="card">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">検索情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">メンバーボックス</label>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="box_0" class="custom-control-input" value="none"
                                                   name="box">
                                            <span class="custom-control-label">未所属</span>
                                        </label>
                                    </div>
                                    @foreach($boxes as $box)
                                        <div class="form-group">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" id="box_{{$box->id}}" class="custom-control-input" value="{{$box->id}}"
                                                       name="box">
                                                <span class="custom-control-label">{{$box->box_name}}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">キャラ選択</label>
                                    <select name="character_id" class="form-control custom-select">
                                        <option value="" selected></option>
                                        @for($i = 0,$iMax = count($characters); $i < $iMax; $i++)
                                            <option value="{{$characters[$i]['id']}}">{{$characters[$i]['unique_id']}}</option>
                                        @endfor
                                    </select>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">無反応--}}
{{--                                    </label>--}}
{{--                                    <div class="row gutters-xs">--}}
{{--                                        <div class="col-4">--}}
{{--                                            <input type="text" id="start_count" class="form-control" name="start_count"--}}
{{--                                                   placeholder="" value="">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-1">--}}
{{--                                            <label for="start_count" class="form-label mt-2">回~</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-4">--}}
{{--                                            <input type="text" id="end_count" class="form-control" name="end_count"--}}
{{--                                                   placeholder="" value="">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-1">--}}
{{--                                            <label for="end_count" class="form-label mt-2">回</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>

                            {{--                            <div class="col-md-6 col-lg-6">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label class="form-label">キャラBOX</label>--}}
                            {{--                                    <select name="characters[]" class="form-control select2" data-placeholder="キャラ" multiple>--}}
                            {{--                                        @for($i = 0; $i < count($characters); $i++)--}}
                            {{--                                            <option value="{{$characters[$i]['id']}}">{{$characters[$i]['unique_id']}}</option>--}}
                            {{--                                        @endfor--}}
                            {{--                                    </select>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
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
                                        <img class="" src="{{asset('img/org.jpg')}}" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group" style="width: 50% !important;">
                                    <label class="form-label">性別</label>
                                    <select name="gender" class="form-control custom-select">
                                        <option value="0">男性</option>
                                        <option value="1">女性</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">メッセージ</label>
                                    <textarea class="form-control" name="description" rows="12" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">課金回数</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" min="0" id="start_money" class="form-control" name="start_money" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_money" class="form-label mt-2">回~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" min="0" id="end_money" class="form-control" name="end_money" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_money" class="form-label mt-2">回</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">キャラ最終送信日時</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div>
                                                    <input id="start_last_character_send_day" class="form-control fc-datepicker" value="" name="start_last_character_send_day" placeholder="MM/DD/YYYY" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <label for="start_last_money_day" class="form-label mt-2">~</label>
                                        </div>
                                        <div class="col-4">
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div>
                                                    <input id="end_last_character_send_day" class="form-control fc-datepicker" value="" name="end_last_character_send_day" placeholder="MM/DD/YYYY" type="text">
                                                </div>
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
                                    <label class="form-label">所持ポイント</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" type="text" id="start_point" class="form-control" name="start_point" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_point" class="form-label mt-2">Pt~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" type="text" id="end_point" class="form-control" name="end_point" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_point" class="form-label mt-2">Pt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">ユーザー最終送信日時</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div><input id="start_last_user_send_day" class="form-control fc-datepicker" name="start_last_user_send_day" value="" placeholder="MM/DD/YYYY" type="text">
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
                                                    </div><input id="end_last_user_send_day" class="form-control fc-datepicker" name="end_last_user_send_day" value="" placeholder="MM/DD/YYYY" type="text">
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
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">青ログ
                                    </label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="number" min="0" id="start_count" class="form-control" name="start_count" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_count" class="form-label mt-2">回~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" min="0" id="end_count" class="form-control" name="end_count" placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="end_count" class="form-label mt-2">回</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">キャラからの返信
                                    </label>
                                    <div class="row custom-controls-stacked">
                                        <div class="col-3">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="reply" value="" checked>
                                                <span class="custom-control-label">指定しない</span>
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="reply" value="0">
                                                <span class="custom-control-label">未返信</span>
                                            </label>
                                        </div>
                                        <div class="col-3">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="reply" value="1">
                                                <span class="custom-control-label">返信済み</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" id="agree" class="custom-control-input" name="repeat"/>
                                        <span class="custom-control-label">ユーザー重複をしない</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button type="submit" id="submit" class="btn btn-primary ml-auto">検索開始</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card" >
                    <div class="card-body" id="table_container">

                    </div>

                    <!-- table-responsive -->
                </div>
            </div>
        </div>

    </div>
@endsection
@section('page-js')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
    <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
    <script type="text/javascript">

        var home_path = $("#home_path").val();
        var characters = JSON.parse($('#characters').val());
        $('#submit').click(function (e) {
            e.preventDefault();
            getMessageList();
        });

        function getMessageList() {
            var token = $("meta[name='_csrf']").attr("content");
            var formData = new FormData();
            let box = [];
            let reply
            $('[name=box]').each(function (i) {
                if($(this)[0].checked){
                    box.push($(this).val());
                }
            })
            $('[name=reply]').each(function (i) {
                if($(this)[0].checked){
                    reply = $(this).val();
                }
            })

            formData.append('box', box);
            formData.append('character_id', $('[name=character_id]').val())
            formData.append('reply', reply)
            formData.append('repeat', $('[name=repeat]')[0].checked)
            formData.append('start_count', $('[name=start_count]').val())
            formData.append('end_count', $('[name=end_count]').val())
            formData.append('start_money', $('[name=start_money]').val())
            formData.append('end_money', $('[name=end_money]').val())
            formData.append('start_last_character_send_day', $('[name=start_last_character_send_day]').val())
            formData.append('end_last_character_send_day', $('[name=end_last_character_send_day]').val())
            formData.append('start_point', $('[name=start_point]').val())
            formData.append('end_point', $('[name=end_point]').val())
            formData.append('end_last_character_send_day', $('[name=end_last_character_send_day]').val())
            formData.append('end_last_user_send_day', $('[name=end_last_user_send_day]').val())

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/dig-message';
            $.ajax({
                url:url,
                type:'post',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $("#global-loader").fadeIn("slow")
                },
                complete: function(){
                    $("#global-loader").fadeOut("slow")
                },
                success: function (response) {
                    $('#table_container').html(response);
                    $('#example').DataTable({
                        "language": {
                            "decimal":        "",
                            "emptyTable":     "表で使用できるデータがありません。",
                            "info":           "_TOTAL_つのエントリのうち_START_~_END_を表示する",
                            "infoEmpty":      "エントリ数0~0の0を表示",
                            "infoFiltered":   "(filtered from _MAX_ total entries)",
                            "infoPostFix":    "",
                            "thousands":      ",",
                            "lengthMenu":     "表示 _MENU_ ",
                            "loadingRecords": "ロード...",
                            "processing":     "処理...",
                            "search":         "検索:",
                            "zeroRecords":    "一致するレコードが見つかりません。",
                            "paginate": {
                                "first":      "最初",
                                "last":       "最終",
                                "next":       "次へ",
                                "previous":   "前へ"
                            },
                            "aria": {
                                "sortAscending":  ": 列を昇順にソートするためにアクティブにする",
                                "sortDescending": ": カラムを降順にソートするためにアクティブにする"
                            }
                        }
                    });
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
        }
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
    </script>

@endsection
