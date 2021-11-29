<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div class="page">
        <div class="page-main">
            <!-- Content area -->
            <div class="app-content my-3 my-md-5">
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
            </div>
            <!-- /content area -->
        </div>
        <input type="hidden" id="home_path" value="<?=url('');?>">
    </div>
    </body>
</html>
