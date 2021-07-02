@extends('admin.layout.base')

@section('page-css')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">キャラボックス</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">キャラボックス</li>
            </ol>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h3 class="card-title">キャラボックス</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('/manage/box_add')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="form-label">ボックス名</label>
                                        <input type="text" class="form-control" name="box_name" placeholder="ボックス名">
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="text-right">
                                        <div class="d-flex" style="margin-top: 20px;">
                                            <button type="submit" class="btn btn-primary ml-auto">キャラボックス追加</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <div class="row mt-5">
                            <div class="table-responsive">
                                <table class="table card-table table-center text-nowrap table-primary" id="dtTable">
                                    <thead  class="bg-primary text-white">
                                    <tr>
                                        <th>ボックス名</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($boxes as $box)
                                        <tr>
                                            <td>{{$box->box_name}}</td>
                                            <td>
                                                <input type="hidden" value="{{$box->id}}">
                                                <button class="btn btn-success ml-auto"><a href="{{url('/manage/box-detail/'. $box->id)}}">編集</a></button>
                                                <button class="member_delete btn btn-primary ml-auto">削除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('page-js')
    <!-- Notifications js -->
    <script src="{{ asset('plugins/notify/js/rainbow.js') }}"></script>
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script type="text/javascript">
        var home_path = $("#home_path").val();
        $(document).ready(function () {
            $('.member_delete').click(function () {
                var token = $("meta[name='_csrf']").attr("content");
                var box_id = $(this).prev().prev().val();

                //return false;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                var url = home_path + '/manage/box-delete';
                $.ajax({
                    url:url,
                    type:'post',
                    data: {
                        box_id : box_id,
                    },
                    success: function (response) {
                        $.growl.notice({
                            title: "成功",
                            message: "削除成功",
                            duration: 2000
                        });
                        window.location.reload();

                    },
                    error: function () {
                        $.growl.warning({
                            title: "警告",
                            message: "エラーが発生しました。",
                            duration: 2000
                        });
                        return false;
                    }
                });
            })

        })
    </script>

@endsection
