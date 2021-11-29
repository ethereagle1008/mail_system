@extends('admin.layout.base')

@section('page-css')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">広告集計</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">広告集計</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form id="validation_form" action="" method="post" name="search" class="card">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">集計条件</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-lg-10">
                                <div class="form-group">
                                    <label class="form-label">集計条件日時</label>
                                    <div class="row gutters-xs">
                                        <div class="col-6 pr-2">
                                            <div class="row">
                                                <div class="col-6 pr-0">
                                                    <div class="wd-200 mg-b-30">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                                </div>
                                                            </div><input id="start_day" class="form-control fc-datepicker" name="start_day" placeholder="MM/DD/YYYY" type="text" value="">
                                                            <input type="hidden" id="start_day_time" name="start_day_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 px-1">
                                                    <select name="start_hour" id="start_hour" class="form-control custom-select">
                                                        @for($i = 0; $i< 24; $i++)
                                                            <option value="{{$i}}">{{$i}}時</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-3 pl-0">
                                                    <select name="start_min" id="start_min" class="form-control custom-select">
                                                        @for($i = 0; $i< 60; $i++)
                                                            <option value="{{$i}}">{{$i}}分</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-2">
                                            <div class="row">
                                                <div class="col-6 pr-0">
                                                    <div class="wd-200 mg-b-30">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                                </div>
                                                            </div><input id="end_day" id="end_day" class="form-control fc-datepicker" name="end_day" placeholder="MM/DD/YYYY" type="text" value="">
                                                            <input type="hidden" id="end_day_time" name="end_day_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 px-1">
                                                    <select name="end_hour" id="end_hour" class="form-control custom-select">
                                                        @for($i = 0; $i< 24; $i++)
                                                            <option value="{{$i}}">{{$i}}時</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-3 pl-0">
                                                    <select name="end_min" id="end_min" class="form-control custom-select">
                                                        @for($i = 0; $i< 60; $i++)
                                                            <option value="{{$i}}">{{$i}}分</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group mb-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-label">広告媒体選択</div>
                                        </div>
{{--                                        <div class="col-6">--}}
{{--                                            <div class="form-label">集計単位</div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="row custom-controls-stacked">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <select name="media_type" class="form-control custom-select" required>
                                                    <option value="" selected></option>
                                                    <option value="Organic">Organic</option>
                                                    <option value="Google Ads CLI">Google Ads CLI</option>
                                                    <option value="Inter Ride">Inter Ride</option>
                                                </select>
                                            </div>
                                        </div>
{{--                                        <div class="col-2 mt-1">--}}
{{--                                            <label class="custom-control custom-radio">--}}
{{--                                                <input type="radio" class="custom-control-input" name="unit" value="hour" {{$search_param['unit'] == 'hour' ? 'checked' : ''}}>--}}
{{--                                                <span class="custom-control-label">時間別</span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-2 mt-1">--}}
{{--                                            <label class="custom-control custom-radio">--}}
{{--                                                <input type="radio" class="custom-control-input" name="unit" value="day" {{$search_param['unit'] == 'day' ? 'checked' : ''}}>--}}
{{--                                                <span class="custom-control-label">日別</span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-2 mt-1">--}}
{{--                                            <label class="custom-control custom-radio">--}}
{{--                                                <input type="radio" class="custom-control-input" name="unit" value="month" {{$search_param['unit'] == 'month' ? 'checked' : ''}}>--}}
{{--                                                <span class="custom-control-label">月別</span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button type="submit" id="btn_submit" class="btn btn-primary ml-auto">集計開始</button>
                        </div>
                    </div>
                </form>
                <div class="card-header">
                    <h3 class="card-title">集計</h3>
                </div>
                <div class="card-body" id="table_container">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <!-- Notifications js -->
    <script src="{{ asset('plugins/notify/js/rainbow.js') }}"></script>
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script language="javascript" type="text/javascript">
        var home_path = $("#home_path").val();
        $(document).ready(function() {
            getCodeList();
            $('#btn_submit').click(function(){
                event.preventDefault();
                getCodeList();
            })
            $('form').submit(function(e) {
                e.preventDefault();
                // or return false;
            });
        })

        function getCodeList() {
            var start_day, end_day, start_register, end_register;
            var i_start_day = $('#start_day').val()
            var i_start_hour = $('#start_hour').val();
            var i_start_min = $('#start_min').val()
            if(i_start_day == null){
                start_day = ''
            }
            else{
                start_day = i_start_day + ' ' + i_start_hour + ':' + i_start_min + ':' + '00';
                $('#start_day_time').val(start_day)
            }
            var i_end_day = $('#end_day').val();
            var i_end_hour = $('#end_hour').val();
            var i_end_min = $('#end_min').val();
            if(i_end_day ==  null){
                end_day = '';
            }
            else{
                end_day = i_end_day + ' ' + i_end_hour + ':' + i_end_min + ':' + '00';
                $('#end_day_time').val(end_day);
            }
            if(end_day !== '' && start_day !== ''){
                var startDate = new Date(start_day);
                var endDate = new Date(end_day);

                if(endDate <= startDate){
                    $.growl.warning({
                        title: "警告",
                        message: "集計条件日時を確認してください。",
                        duration: 3000
                    });
                    return false;
                }
            }

            let form = $('#validation_form')[0];
            var formData = new FormData(form);
            var token = $("meta[name='_csrf']").attr("content");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/ad-total-list';
            $.ajax({
                url:url,
                type:'post',
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
