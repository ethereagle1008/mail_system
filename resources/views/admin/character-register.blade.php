@extends('admin.layout.base')

@section('page-css')

@endsection

@section('content')
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">キャラ登録</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">キャラ登録</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{url('/manage/character-register')}}" method="post" name="register" class="card" id="validation_form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">基本情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">名称 *</label>
                                    <input type="text" class="form-control" name="name" placeholder="名称" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">生年月日 *</label>
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
                                    <label class="form-label">削減ポイント *</label>
                                    <input type="number" class="form-control" max="150" min="0" name="decreasing_point" placeholder="削減ポイント" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">プロファイル画像</label>
                                    <div class="preview" style="margin: 20px;">
                                        <img id="photo-preview" src="" alt="no_img" style=" width: 100px">
                                        <button id="img_del" class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                                    </div>
{{--                                    <div class="d-flex" id="profile_img">--}}
{{--                                        <img class="" src="{{asset('img/org.jpg')}}">--}}
{{--                                    </div>--}}
                                    <button type="button" id="img_add" class="" onclick="openFile()" style="">写真を添付</button>
                                    <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group" style="width: 50% !important;">
                                    <label class="form-label">性別 *</label>
                                    <select name="gender" class="form-control custom-select">
                                        <option value="0">男性</option>
                                        <option value="1">女性</option>
                                    </select>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">位置情報</label>--}}
{{--                                    <select name="position" class="form-control custom-select">--}}
{{--                                        <option value="male">ワイルド</option>--}}
{{--                                        <option value="female">固定</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}

                                <div class="form-group">
                                    <label class="form-label">メッセージ *</label>
                                    <textarea class="form-control" name="description" rows="12" placeholder="" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-left">
                        <div class="d-flex">
                            <button type="submit" id="btn_submit" class="btn btn-primary mr-auto">キャラ登録</button>
                        </div>
                    </div>
                </form>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.preview').hide();
            $('form').submit(function(e) {
                e.preventDefault();
                // or return false;
            });
            $('#btn_submit').click(function () {
                var forms = document.getElementById('validation_form');
                forms.classList.add('was-validated');
                if (forms.checkValidity() === true) {
                    document.register.submit();
                }
            })
        });
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
        function deleteImg() {
            $('.preview').hide();
            $('#photo-preview').attr('src',"");
            $('#photo').val('');
        }
    </script>

@endsection
