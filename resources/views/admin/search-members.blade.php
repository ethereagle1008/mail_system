@extends('admin.layout.base')

@section('page-css')
    <style>
        #user_table_filter{
            display: none;
        }
    </style>

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">メンバー検索</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">メンバー検索</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="card" method="POST" enctype="multipart/form-data" id="search_form">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">基本情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">メンバーID</label>
                                    <input type="number" class="form-control" name="unique_id" placeholder="メンバーID"
                                           value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">名称</label>
                                    <input type="text" class="form-control" name="name" placeholder="名称"
                                           value="">
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">性別</label>
                                    <select name="gender" class="form-control custom-select">
                                        <option value="" selected></option>
                                        <option value="0">男性</option>
                                        <option value="1">女性</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">年齢</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="text" id="start_age" class="form-control" name="start_age"
                                                   placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_age" class="form-label mt-2">歳~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_age" class="form-control" name="end_age"
                                                   placeholder="" value="">
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
                                    <label class="form-label">入金回数</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="text" id="start_count" class="form-control" name="start_count"
                                                   placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_count" class="form-label mt-2">回~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_count" class="form-control" name="end_count"
                                                   placeholder="" value="">
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
                                            <input type="text" id="start_money" class="form-control" name="start_money"
                                                   placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_money" class="form-label mt-2">円~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_money" class="form-control" name="end_money"
                                                   placeholder="" value="">
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
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div>
                                                    <input id="start_last_money_day" class="form-control fc-datepicker"
                                                           value=""
                                                           name="start_last_money_day" placeholder="MM/DD/YYYY"
                                                           type="text">
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
                                                    <input id="end_last_money_day" class="form-control fc-datepicker"
                                                           value=""
                                                           name="end_last_money_day" placeholder="MM/DD/YYYY"
                                                           type="text">
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
                                    <label class="form-label">残りポイント</label>
                                    <div class="row gutters-xs">
                                        <div class="col-4">
                                            <input type="text" id="start_point" class="form-control" name="start_point"
                                                   placeholder="" value="">
                                        </div>
                                        <div class="col-1">
                                            <label for="start_point" class="form-label mt-2">P~</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="end_point" class="form-control" name="end_point"
                                                   placeholder="" value="">
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
                                            <div class="wd-200 mg-b-30">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                    </div>
                                                    <input id="start_last_login_day" class="form-control fc-datepicker"
                                                           name="start_last_login_day"
                                                           value=""
                                                           placeholder="MM/DD/YYYY" type="text">
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
                                                    </div>
                                                    <input id="end_last_login_day" class="form-control fc-datepicker"
                                                           name="end_last_login_day"
                                                           value=""
                                                           placeholder="MM/DD/YYYY" type="text">
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
                            <button type="submit" id="submit" class="btn btn-primary ml-auto">検索開始</button>
                        </div>
                    </div>
                </form>
                <div class="card-header">
                    <h3 class="card-title">メンバー</h3>
                </div>
                <div class="card">
                    <div class="card-footer text-right pb-0">
                        <div class="d-flex">
                            <button class="btn btn-primary ml-auto btn-del">削除</button>
                        </div>
                    </div>
                    <div class="card-body pt-0" id="table_container">

                    </div>
                </div>
            </div>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-12 col-lg-12">--}}
{{--                <div class="card">--}}

{{--                    <!-- table-responsive -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
@endsection
@section('page-js')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script type="text/javascript">
        var delayTimer;
        var home_path = $("#home_path").val();
        let user_ids = [];
        $(document).ready(function () {
            getUserList();

        })
        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        //removeA(ary, 'seven');
        $(document).on('click', '.header-checkbox', function () {
            if($(this)[0].checked){
                $('.tr-checkbox').each(function (id) {
                    $(this)[0].checked = true;
                    user_ids.push($(this).val());
                })
            }
            else{
                $('.tr-checkbox').each(function (id) {
                    $(this)[0].checked = false;
                })
                user_ids = [];
            }
            console.log(user_ids);
        })
        $(document).on('click', '.tr-checkbox', function () {
            if($(this)[0].checked){
                user_ids.push($(this).val())
            }
            else{
                removeA(user_ids, $(this).val());
            }
            console.log(user_ids);

        })
        $(document).on('click', '.btn-del', function () {
            if(user_ids.length == 0) return;
            var token = $("meta[name='_csrf']").attr("content");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/member-multi-delete';
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    user_id: user_ids,
                },
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "削除成功",
                        duration: 3000
                    });
                    getUserList();

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
        $(document).on('click', '.member_delete', function () {
            var token = $("meta[name='_csrf']").attr("content");
            var user_id = $(this).prev().val();

            //return false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/member-delete';
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    user_id: user_id,
                },
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "削除成功",
                        duration: 3000
                    });
                    getUserList();

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
        // function input(ele) {
        //     console.log(ele.value);
        //     clearTimeout(delayTimer);
        //     delayTimer = setTimeout(function() {
        //         ele.value = parseFloat(ele.value).toFixed(2);
        //     }, 10);
        // }



        //var characters = JSON.parse($('#characters').val());
        $('#submit').click(function (e) {
            e.preventDefault();
            getUserList();
        });

        function getUserList() {
            var token = $("meta[name='_csrf']").attr("content");
            let form = $('#search_form')[0];
            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/search-members';
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
                    $('#user_table').DataTable({
                        "columnDefs": [
                            { "orderable": false, "targets": 0 }
                        ],
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
                        },
                        "lengthMenu": [ [10, 20, 50, 100, -1], [10, 20, 50, 100, "全部"] ]
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
    </script>

@endsection
