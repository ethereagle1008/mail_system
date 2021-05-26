@extends('admin.layout.base')

@section('page-css')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">売上集計</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">売上集計</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{url('/manage/total-sales')}}" method="post" name="search" class="card">
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
                                                            </div><input id="start_day" class="form-control fc-datepicker" name="start_day" placeholder="MM/DD/YYYY" type="text" value="{{$search_param['start_day']}}">
                                                            <input type="hidden" id="start_day_time" name="start_day_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 px-1">
                                                    <select name="start_hour" id="start_hour" class="form-control custom-select">
                                                        @for($i = 0; $i< 24; $i++)
                                                            <option value="{{$i}}" {{$search_param['start_hour'] == $i ? 'selected' : ''}}>{{$i}}時</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-3 pl-0">
                                                    <select name="start_min" id="start_min" class="form-control custom-select">
                                                        @for($i = 0; $i< 60; $i++)
                                                            <option value="{{$i}}" {{$search_param['start_min'] == $i ? 'selected' : ''}}>{{$i}}分</option>
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
                                                            </div><input id="end_day" id="end_day" class="form-control fc-datepicker" name="end_day" placeholder="MM/DD/YYYY" type="text" value="{{$search_param['end_day']}}">
                                                            <input type="hidden" id="end_day_time" name="end_day_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 px-1">
                                                    <select name="end_hour" id="end_hour" class="form-control custom-select">
                                                        @for($i = 0; $i< 24; $i++)
                                                            <option value="{{$i}}" {{$search_param['end_hour'] == $i ? 'selected' : ''}}>{{$i}}時</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-3 pl-0">
                                                    <select name="end_min" id="end_min" class="form-control custom-select">
                                                        @for($i = 0; $i< 60; $i++)
                                                            <option value="{{$i}}" {{$search_param['end_min'] == $i ? 'selected' : ''}}>{{$i}}分</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10">
                                <div class="form-group">
                                    <label class="form-label">登録日時</label>
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
                                                            </div><input id="start_register" class="form-control fc-datepicker" name="start_register" placeholder="MM/DD/YYYY" type="text" value="{{$search_param['start_register']}}">
                                                            <input type="hidden" id="start_register_time" name="start_register_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 px-1">
                                                    <select name="start_register_hour" id="start_register_hour" class="form-control custom-select">
                                                        @for($i = 0; $i< 24; $i++)
                                                            <option value="{{$i}}" {{$search_param['start_register_hour'] == $i ? 'selected' : ''}}>{{$i}}時</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-3 pl-0">
                                                    <select name="start_register_min" id="start_register_min" class="form-control custom-select">
                                                        @for($i = 0; $i< 60; $i++)
                                                            <option value="{{$i}}" {{$search_param['start_register_min'] == $i ? 'selected' : ''}}>{{$i}}分</option>
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
                                                            </div><input id="end_register" class="form-control fc-datepicker" name="end_register" placeholder="MM/DD/YYYY" type="text" value="{{$search_param['end_register']}}">
                                                            <input type="hidden" id="end_register_time" name="end_register_time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 px-1">
                                                    <select name="end_register_hour" id="end_register_hour" class="form-control custom-select">
                                                        @for($i = 0; $i< 24; $i++)
                                                            <option value="{{$i}}" {{$search_param['end_register_hour'] == $i ? 'selected' : ''}}>{{$i}}時</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-3 pl-0">
                                                    <select name="end_register_min" id="end_register_min" class="form-control custom-select">
                                                        @for($i = 0; $i< 60; $i++)
                                                            <option value="{{$i}}" {{$search_param['end_register_min'] == $i ? 'selected' : ''}}>{{$i}}分</option>
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
                                    <div class="form-label">集計単位</div>
                                    <div class="row custom-controls-stacked">
                                        <div class="col-2">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="unit" value="hour" {{$search_param['unit'] == 'hour' ? 'checked' : ''}}>
                                                <span class="custom-control-label">時間別</span>
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="unit" value="day" {{$search_param['unit'] == 'day' ? 'checked' : ''}}>
                                                <span class="custom-control-label">日別</span>
                                            </label>
                                        </div>
                                        <div class="col-2">
                                            <label class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="unit" value="month" {{$search_param['unit'] == 'month' ? 'checked' : ''}}>
                                                <span class="custom-control-label">月別</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <button type="submit" id="total" class="btn btn-primary ml-auto">集計開始</button>
                        </div>
                    </div>
                </form>
                    <div class="card-header">
                        <h3 class="card-title">集計</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-center text-nowrap table-primary" id="dtTable">
                            <thead  class="bg-primary text-white">
                            <tr>
                                <th>時間</th>
                                <th>入金額</th>
                                <th>ポイント</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($point_lists as $list)
                                <tr>
                                    <td>{{$list->hour_str}}</td>
                                    <td>{{$list->price}}円</td>
                                    <td>{{$list->point}}pt</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <!-- Notifications js -->
    <script src="{{ asset('plugins/notify/js/rainbow.js') }}"></script>
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                // or return false;
            });
            $('#total').click(function () {
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

                var i_start_register_day = $('#start_register').val()
                var i_start_register_hour = $('#start_register_hour').val();
                var i_start_register_min = $('#start_register_min').val()
                if(i_start_register_day == null){
                    start_register = ''
                }
                else{
                    start_register = i_start_register_day + ' ' + i_start_register_hour + ':' + i_start_register_min + ':' + '00';
                    $('#start_register_time').val(start_register);
                }
                var i_end_register_day = $('#end_register').val();
                var i_end_register_hour = $('#end_register_hour').val();
                var i_end_register_min = $('#end_register_min').val();
                if(i_end_register_day ==  null){
                    end_register = '';
                }
                else{
                    end_register = i_end_register_day + ' ' + i_end_register_hour + ':' + i_end_register_min + ':' + '00';
                    $('#end_register_time').val(end_register)
                }
                if(end_register !== '' && start_register !== ''){
                    var startDate = new Date(start_register);
                    var endDate = new Date(end_register);

                    if(endDate <= startDate){
                        $.growl.warning({
                            title: "警告",
                            message: "登録日時を確認してください。",
                            duration: 3000
                        });
                        return false;
                    }
                }
                document.search.submit();

                // unit = $("input[name='unit']:checked").val();
                // console.log(unit);

                // refreshTable(start_day, end_day, start_register, end_register, unit);
            })
            // refreshTable('', '', '', '', 'hour');
        })
        {{--function refreshTable(start_day, end_day, start_register, end_register, unit) {--}}
        {{--    try {--}}
        {{--        dt.destroy()--}}
        {{--    } catch (e) {--}}
        {{--    }--}}
        {{--    let _token = $("meta[name='_csrf']").attr("content");--}}
        {{--    dt = $('#dtTable').DataTable({--}}
        {{--        pageLength:20,--}}
        {{--        ajax: {--}}
        {{--            url: '{{url('/manage/total-sales')}}',--}}
        {{--            type: "POST",--}}
        {{--            data: {start_day: start_day,end_day:end_day, start_register: start_register, end_register: end_register, unit: unit,_token: _token},--}}
        {{--        },--}}
        {{--        searching: false,--}}
        {{--        bLengthChange: false,--}}
        {{--        columns: [--}}
        {{--            {"data": "date_time"},--}}
        {{--            {"data": "price"},--}}
        {{--            {"data": "point"},--}}
        {{--        ],--}}
        {{--    });--}}
        {{--}--}}

    </script>

@endsection
