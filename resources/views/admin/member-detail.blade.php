@extends('admin.layout.base')

@section('page-css')

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
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body p-6">
                        <div class="panel panel-primary">
                            <div class="tab_wrapper first_tab">
                                <ul class="tab_list">
                                    <li class="active">プロファイル</li>
                                    <li>メール履歴</li>

                                </ul>

                                <div class="content_wrapper">
                                    <div class="tab_content active">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row mb-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">プロフ画像</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="preview" id="character_img" style="margin: 20px; display: block !important;" >
                                                            <img class="photo-preview height-1 mx-auto" src="{{isset($member->image) ? $member->image : asset('img/user.jpeg')}}">
                                                            <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                                                        </div>

                                                        <a class="add_img mx-3 btn_base btn_short action deco action_camera" style="cursor: pointer; border: 1px solid">写真を添付</a>
                                                        <input type="file" class="d-none" id="photo_character" name="photo" accept="image/*">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{$member->id}}">
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">メンバーID</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="text-left" style="color: greenyellow">{{$member->unique_id}}</p>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">名前</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="name" placeholder="名前" value="{{$member->name}}">
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">性別</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <select name="gender" class="form-control custom-select">
                                                            <option value="0" {{$member['gender'] == '0' ? 'selected':''}}>男性</option>
                                                            <option value="1" {{$member['gender'] == '1' ? 'selected':''}}>女性</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">生年月日</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="wd-200 mg-b-30">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                                    </div>
                                                                </div><input id="birthday" class="form-control fc-datepicker" name="birth" placeholder="MM/DD/YYYY" value="{{$member->birth}}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">お住まいの地域</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="region" placeholder="お住まいの地域" value="{{$member->region}}">

{{--                                                        <select name="region" class="form-control custom-select">--}}
{{--                                                            @foreach($regions as $one)--}}
{{--                                                                <option value="{{$one->name}}" {{$member->region == $one->name? 'selected' : ''}}>{{$one->name}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">課金回数</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label type="text" class="form-control">{{$member->pay_cnt}}</label>
                                                    </div>
                                                </div>

                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">最終ログイン時間</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label type="text" class="form-control">{{$member->last_login}}</label>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">課金金額</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label type="text" class="form-control">{{$member->pay}}</label>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">登録日時</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label type="text" class="form-control">{{$member->email_verified_at}}</label>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">保有ポイント</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label type="text" class="form-control">{{$member->point}}pt</label>
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-6 d-flex align-content-center">
                                                        <p class="text-center m-auto">メモ</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="hidden" value="{{$member->id}}" name="user_id">
                                                        <textarea type="text" class="form-control" name="memo" rows="20" placeholder="" style="width: 150%">{{$member->memo}}</textarea>
                                                    </div>
                                                    <div class="col-6"></div>
                                                    <div class="col-3 d-flex pt-2">
                                                        <button type="submit" class="btn btn-primary mr-auto" id="save_memo">メモ保存</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-right">
                                                        <input type="submit" value=" 更新 " id="modify_character" class="btn btn-primary mr-auto" style="cursor: pointer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="{{url('/manage/member-point')}}" method="post" class="card">
                                                    @csrf
                                                    <input type="hidden" value="{{$member->id}}" name="member_id">
                                                    <div class="card-header">
                                                        <h3 class="card-title">ポイント追加</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4 col-lg-4 d-none">
                                                                <div class="form-group">
                                                                    <label class="form-label">入金額 *</label>
                                                                    <input type="number" class="form-control" name="price" value="0" placeholder="入金額" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="form-label">ポイント *</label>
                                                                    <input type="number" class="form-control" name="point" placeholder="ポイント" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer text-left">
                                                        <div class="d-flex">
                                                            <button type="submit" id="btn_submit" class="btn btn-primary mr-auto">ポイント追加</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content">
                                       <div class="row">
                                           <div class="col-2">
                                               <img class="height-1 mx-auto" src="{{isset($member->image) ? $member->image : asset('img/user.jpeg')}}">
                                           </div>
                                           <div class="col-2">
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">メンバーID</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">名前(性別)</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">年齢(生年月日)</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">登録日時</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">保有ポイント</p>
                                               </div>
                                           </div>
                                           <div class="col-3">
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">
                                                       {{$member->unique_id}}
                                                   </p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">{{$member->name}}({{$member->gender == '0' ? '男性' : '女性'}})</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">{{$member->age}}({{$member->birth}})</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">{{$member->email_verified_at}}</p>
                                               </div>
                                               <div class="row d-flex my-1">
                                                   <p class="text-center">{{$member->point}}pt</p>
                                               </div>
                                           </div>
                                       </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <p>メール履歴</p>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table card-table table-vcenter text-nowrap table-primary" >
                                                        <thead  class="bg-primary text-white">
                                                        <tr >
                                                            <th class="text-white" width="40%">キャラ</th>
                                                            <th class="text-white" width="40%">内容</th>
                                                            <th class="text-white" width="20%">やりとりイメージ</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($questions as $question)
                                                            <tr>
                                                                <td>
                                                                    <div class="row text-center">
                                                                        <div class="col-12 mb-3">
                                                                            <a href="{{url('/manage/character-detail/'.$question->character_id)}}">{{$question->name}}</a>[{{$question->age}}歳]
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <img src="{{isset($question->image) ? $question->image : asset('img/user.jpeg')}}" style="width: 100px !important;">
                                                                        </div>
                                                                        <div class="col-12 text-center mt-3">
                                                                            <label>--- キャラメモ ---
                                                                            </label>
                                                                            @if(!empty($question->description))
                                                                                <p class="mt-0 p-2" style="text-align: left; background:white; border: 1px solid; white-space: pre-line">{{$question->description}}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <p>{{$question->receive_date}}
                                                                        @if(date('Y-m-d H:i:s', strtotime($question->receive_date)) > date('Y-m-d H:i:s'))
                                                                            予約
                                                                        @else
                                                                            @if($question->type == 'user_sent')送信@else受信@endif</p>
                                                                        @endif
                                                                    </p>
                                                                    <p style="white-space: pre-line;">{{$question->content}}</p></td>

                                                                <th scope="row">@if(isset($question->image_url))<img src="{{$question->image_url}}" style="width: 100px !important;">@endif</th>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="float-right">
                                                        {!! $questions->appends($pagination_params)->render() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 d-none">
                                                <div class="row mb-3">
                                                    <p>メール統計</p>
                                                </div>
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table card-table table-vcenter text-nowrap table-primary" >
                                                            <thead  class="bg-primary text-white">
                                                            <tr >
                                                                <th class="text-white">イメージ</th>
                                                                <th class="text-white">内容</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Joan Powell</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>Gavin Gibson</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Julian Kerr</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">4</th>
                                                                <td>Cedric Kelly</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5</th>
                                                                <td>Samantha May</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <link href="{{ asset('plugins/notify/css/jquery.growl.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/notify/js/jquery.growl.js') }}"></script>
    <script>
        var home_path = $("#home_path").val();
        $('#save_memo').click(function () {
            var token = $("meta[name='_csrf']").attr("content");
            var memo = $('[name=memo]').val();
            console.log(memo);
            if(memo == '') return;

            //return false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            var url = home_path + '/manage/save-memo';
            $.ajax({
                url:url,
                type:'post',
                data: {
                    user_id : $('[name=user_id]').val(),
                    memo : $('[name=memo]').val(),
                },
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "メモ保存成功",
                        duration: 3000
                    });

                },
                error: function () {
                    $.growl.warning({
                        title: "警告",
                        message: "メモ保存失敗",
                        duration: 3000
                    });
                    return false;
                }
            });
        })
        $(function(e) {
            $(".first_tab").champ();
            $(".accordion_example").champ({
                plugin_type: "accordion",
                side: "left",
                active_tab: "3",
                controllers: "true"
            });

            $(".second_tab").champ({
                plugin_type: "tab",
                side: "right",
                active_tab: "1",
                controllers: "false"
            });

        });
        $('.btn-danger').click(function () {
            $(this).parent().hide();
            $(this).parent().find('.photo-preview')[0].src = '';
            $(this).parent().parent().find('[name=photo]').val('');

        })
        $('.add_img').click(function () {
            $(this).next().trigger('click');
        })
        function openFile() {
            $('#photo').trigger('click');
        }
        $("[name=photo]").on("change", function(){
            var t = $(this);
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    t.parent().find('.photo-preview')[0].src = e.target.result;
                    t.parent().find('.preview').show();
                    console.log( t.parent().find('.photo-preview'));
                }
                reader.readAsDataURL(this.files[0]);
            }
        })
        $('#modify_character').click(function () {
            var token = $("meta[name='_csrf']").attr("content");
            var name = $(this).parent().parent().parent().find('input[name=name]').val();
            var gender = $(this).parent().parent().parent().find('[name=gender]').val();
            var region = $(this).parent().parent().parent().find('[name=region]').val();
            var birthday = $(this).parent().parent().parent().find('input[name=birth]').val();
            var photo = $(this).parent().parent().parent().find('[name=photo]')[0].files[0];
            var user_id = $(this).parent().parent().parent().find('input[name=user_id]').val();


            if(name == '') return;
            if(birthday=='1') return;
            var formData = new FormData();
            formData.append('name', name);
            formData.append('gender', gender);
            formData.append('region', region);
            formData.append('user_id', user_id);
            formData.append('birthday', birthday);
            formData.append('photo', photo);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            var url = home_path + '/manage/modify-user';
            $.ajax({
                url:url,
                type:'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $.growl.notice({
                        title: "成功",
                        message: "更新成功",
                        duration: 3000
                    });

                },
                error: function () {
                    $.growl.warning({
                        title: "警告",
                        message: "更新失敗",
                        duration: 3000
                    });
                    return false;
                }
            });
        })
    </script>

@endsection
