@extends('admin.layout.base')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">メール検索</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">メール検索</li>
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
                                <div class="form-group">
                                    <label class="form-label">キャラID</label>
                                    <input type="text" class="form-control" id="character_id" name="character_id" placeholder="キャラID">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">メンバーID</label>
                                    <input type="text" class="form-control" id="member_id" name="member_id" placeholder="メンバーID">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">キャラ名称</label>
                                    <input type="text" class="form-control" id="character_name" name="character_name" placeholder="キャラ名称">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">メンバー名称</label>
                                    <input type="text" class="form-control" id="member_name" name="member_name" placeholder="メンバー名称">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <div class="d-flex">
                            <label id="submit" class="btn btn-primary ml-auto">検索開始</label>
                        </div>
                    </div>
                </form>
                <div class="card-header">
                    <h3 class="card-title">受信メール</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card" id="table_container">

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
            getMessageList();
            $('#submit').click(function () {
                getMessageList();
            })
            function getMessageList() {
                var token = $("meta[name='_csrf']").attr("content");
                var formData = new FormData();

                formData.append('character_id', $('#character_id').val())
                formData.append('member_id', $('#member_id').val())
                formData.append('character_name', $('#character_name').val())
                formData.append('member_name', $('#member_name').val())
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                var url = home_path + '/manage/message-list';
                $.ajax({
                    url:url,
                    type:'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#table_container').html(response);
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
        });



    </script>


@endsection
