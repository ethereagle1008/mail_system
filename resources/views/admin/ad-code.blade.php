@extends('admin.layout.base')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">広告コード登録</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">広告コード登録</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{url('/manage/add-code')}}" method="post" name="register" class="card" id="validation_form">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">基本情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">広告コード *</label>
                                    <input type="text" class="form-control" name="code" placeholder="広告コード" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group" style="width: 50% !important;">
                                    <label class="form-label">媒体選択 *</label>
                                    <select name="media_type" class="form-control custom-select">
                                        <option value="Organic">Organic</option>
                                        <option value="Google Ads CLI">Google Ads CLI</option>
                                        <option value="Inter Ride">Inter Ride</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-left">
                        <div class="d-flex">
                            <button type="submit" id="btn_submit" class="btn btn-primary mr-auto">広告コード登録</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <!-- table-responsive -->
                    <div class="card-body" id="table_container">

                    </div>
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
        $(document).ready(function() {
            getCodeList();
            $('#btn_submit').click(function(){
                event.preventDefault();
                addCode();
            })
        });
        function addCode() {
            var token = $("meta[name='_csrf']").attr("content");
            let form = $('#validation_form')[0];
            var formData = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/add-code';
            $.ajax({
                url: url,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#global-loader").fadeIn("slow")
                },
                complete: function () {
                    $("#global-loader").fadeOut("slow")
                },
                success: function (response) {
                    $.growl.notice({
                        title: "成功 ",
                        message: "広告コードを登録しました。",
                        duration: 3000
                    });
                    getCodeList();
                }
            })
        }
        function getCodeList() {
            var token = $("meta[name='_csrf']").attr("content");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/ad-list';
            $.ajax({
                url:url,
                type:'get',
                data: {
                },
                success: function (response) {
                    $('#table_container').html(response);
                    $('#code_table').DataTable({
                        "columnDefs": [
                            { "orderable": false, "targets": 0 }
                        ],
                        "search" : false,
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
