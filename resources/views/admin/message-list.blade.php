<div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap table-primary" >
        <thead  class="bg-primary text-white">
        <tr >
            <th width="15%" class="text-white">キャラ</th>
            <th width="15%" class="text-white">メンバー</th>
            <th width="20%" class="text-white">メンバー情報</th>
            <th width="20%" class="text-white">未対応トーク</th>
            <th width="30%" class="text-white">返信用フォーム</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
        <tr>
            <th>
                <div class="row text-center">
                    <div class="col-12">
                        <img src="{{isset($message->character_image) ? $message->character_image : asset('img/user.jpeg')}}" style="width: 100px !important;">
                    </div>
                    <div class="col-12 mb-3">
                        <a href="{{url('/manage/character-detail/'.$message->character_index)}}">{{$message->character_name}}</a>
                        <br>[{{$message->c_age}}歳]
                    </div>
                </div>
            </th>
            <td>
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{isset($message->user_image) ? $message->user_image : asset('img/user.jpeg')}}" style="width: 100px !important;">
                    </div>
                    <div class="col-12 text-center">
                        <a href="{{url('/manage/member-detail/'.$message->user_index)}}">{{$message->member_name}}</a>
                        <br>[{{$message->u_age}}歳]
                    </div>

                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col-12 text-center">
                        <label>最終ログイン時間:<br>{{$message->last_login}}<br>
                            課金回数: {{$message->pay_cnt}}<br>
                            課金金額: {{$message->pay}}<br>
                            登録日時: {{$message->email_verified_at}}<br>
                            保有ポイント: {{$message->point}}
                        </label>
                    </div>
                </div>
            </td>
            <td>
                @if(isset($message->image_url))
                    <div class="description">
                        <figure><img src="{{$message->image_url}}" alt=""></figure>
                    </div>
                @endif
                <p>{{$message->receive_date}}受信</p>
                <p style="white-space: pre-line;">{{$message->content}}</p>
            </td>
            <td>
                <input type="hidden" name="user_id" value="{{$message->user_index}}">
                <input type="hidden" name="question_id" value="{{$message->question_id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group ">
                            <div class="form-label">送信日時</div>
                            <div class="custom-controls-stacked d-flex">
                                <label class="custom-control custom-radio mr-4">
                                    <input type="radio" class="custom-control-input" name="type_{{$message->question_id}}" value="0" checked>
                                    <span class="custom-control-label">今すぐ</span>
                                </label>
                                <label class="custom-control custom-radio d-flex">
                                    <input type="radio" class="custom-control-input" name="type_{{$message->question_id}}" value="1">
                                    <span class="custom-control-label">予約</span>
                                    <div class="dIB mt-n2 ml-2" style="margin-top: -8px;">
                                        <link rel="stylesheet" type="text/css" href="{{asset('/css/jquery.datetimepicker.css')}}">
                                        <script type="text/javascript" src="{{asset('/js/jquery.datetimepicker.js')}}"></script>
                                        <script>
                                            $(function(){
                                                $('input[name="send_time"]').datetimepicker({
                                                    minDate: 0,
                                                    lang: 'ja',
                                                    step: 1,		// Step time(minute)
                                                    format:	'Y-m-d H:i:00',
                                                    closeOnDateSelect:false,
                                                    allowBlank: true,
                                                    timepicker: true, // 時間表示
                                                    defaultTime: new Date(new Date().getTime() + 150*1000/*+150ms*/), // 現在時刻からStepTimeの半分を指定（四捨五入され最寄りの5分後がデフォルト表示となる）
                                                    onShow: function(time, self){
                                                        $('input[type=radio]', self.closest('label')).prop('checked', 'checked');
                                                    }
                                                });
                                            });
                                        </script>
                                        <input type="datetime" class="datetimepicker input-sm form-control" name="send_time" id="send_time">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="count_wrap"><span class="count">送信内容</span></div>
                        <div class="form-group d-flex mb-0">
                            <div class="mr-1">
                                <label id="btn_name" class="btn btn-primary mr-auto btn_name">NAME</label>
                            </div>
                            <div class="mx-1">
                                <label id="btn_mail" class="btn btn-primary mr-auto btn_mail">MAIL</label>
                            </div>
                            <div class="mx-1">
                                <label id="btn_phone" class="btn btn-primary mr-auto btn_phone">PHONE</label>
                            </div>
                            <div class="mx-1">
                                <label id="btn_age" class="btn btn-primary mr-auto btn_age">AGE</label>
                            </div>
                            <div class="mx-1">
                                <label id="btn_birth" class="btn btn-primary mr-auto btn_birth">BIRTH</label>
                            </div>
                            <div class="mx-1">
                                <label id="btn_area" class="btn btn-primary mr-auto btn_area">PREF</label>
                            </div>
                            <div class="ml-1">
                                <label id="btn_gender" class="btn btn-primary mr-auto btn_gender">SEX</label>
                            </div>
                        </div>
                        <textarea class="form_area" name="question_content" rows="10" required style="width: 100%"
                                  placeholder="※全角1,000文字以内でご入力ください。"></textarea>

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12">
                        <div class="preview" style="margin: 20px;">
                            <img class="photo-preview" src="" alt="no_img" style=" width: 100px">
                            <button class="btn btn-sm btn-danger" onclick="deleteImg()">削除</button>
                        </div>
                        <input type="hidden" name="character_id" value="{{$message->character_index}}">

                        <a class="add_img mx-3 btn_base btn_short action deco action_camera" style="cursor: pointer; border: 1px solid">写真を添付</a>
                        <input type="file" class="d-none" id="photo" name="photo" accept="image/*">
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                        <input type="submit" value=" 送信 " class="btn_submit btn_base btn_half forward_siteclr" style="cursor: pointer">
                    </div>

                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {!! $messages->appends($pagination_params)->render() !!}
    </div>
</div>
<script type="text/javascript">
    var home_path = $("#home_path").val();
    $(document).ready(function () {
        $('.page-link').click(function (e) {
            e.preventDefault();
            var rel = $(this).attr('href')
            var rel_arr = rel.split('=');
            var page = rel_arr[rel_arr.length-1];
            var formData = new FormData();
            formData.append('page', page);
            formData.append('character_id', $('#character_id').val())
            formData.append('member_id', $('#member_id').val())
            formData.append('character_name', $('#character_name').val())
            formData.append('member_name', $('#member_name').val())
            getMessageList(formData);
        })

    })

    $(".preview").each(function() {
        if($(this)[0].id !== 'character_img'){
            $(this).hide();
        }
    });

    $('.btn_name').click(function () {
        console.log($(this).parent().parent().next().val());
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%username%';
        $(this).parent().parent().next().val(a_txt);
    })
    $('.btn_mail').click(function () {
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%usermail%';
        $(this).parent().parent().next().val(a_txt);
    })
    $('.btn_phone').click(function () {
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%userphone%';
        $(this).parent().parent().next().val(a_txt);
    })
    $('.btn_age').click(function () {
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%userage%';
        $(this).parent().parent().next().val(a_txt);
    })
    $('.btn_birth').click(function () {
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%userbirth%';
        $(this).parent().parent().next().val(a_txt);
    })
    $('.btn_area').click(function () {
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%userpref%';
        $(this).parent().parent().next().val(a_txt);
    })
    $('.btn_gender').click(function () {
        var o_txt = $(this).parent().parent().next().val();
        var a_txt = o_txt + '%usersex%';
        $(this).parent().parent().next().val(a_txt);
    })

    var character_img

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

    $('#character_img').on('change', function () {
        if (this.files && this.files[0]) {
            character_img = this.files[0];
            console.log(character_img);
        }
    })

    $('.btn_submit').click(function () {
        var token = $("meta[name='_csrf']").attr("content");
        var user_id = $(this).parent().parent().parent().find('input[name=user_id]').val();
        var question_id = $(this).parent().parent().parent().find('input[name=question_id]').val();
        var character_id = $(this).parent().parent().parent().find('input[name=character_id]').val();
        var type = $(this).parent().parent().parent().find('input:radio:checked').val();
        var send_time = $(this).parent().parent().parent().find('input[name=send_time]').val();
        var question_content = $(this).parent().parent().parent().find('[name=question_content]').val();
        var photo = $(this).parent().parent().parent().find('input[name=photo]')[0].files[0];

        if(type == '' || type == undefined) return;
        if(type==1 && send_time == '') return;
        if(question_content == '') return;
        var formData = new FormData();
        formData.append('user_id', user_id);
        formData.append('question_id', question_id);
        formData.append('character_id', character_id);
        formData.append('type', type);
        formData.append('send_time', send_time);
        formData.append('question_content', question_content);
        formData.append('photo', photo);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        var url = home_path + '/manage/user-send';
        $.ajax({
            url:url,
            type:'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $.growl.notice({
                    title: "成功",
                    message: "送信成功",
                    duration: 3000
                });
                window.location.reload();
            },
            error: function () {
                $.growl.warning({
                    title: "警告",
                    message: "送信失敗",
                    duration: 3000
                });
                return false;
            }
        });
    })

    $('.btn-danger').click(function () {
        $(this).parent().hide();
        $(this).parent().find('.photo-preview')[0].src = '';
        $(this).parent().parent().find('[name=photo]').val('');

    })

    function getMessageList(form) {
        var token = $("meta[name='_csrf']").attr("content");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        var url = home_path + '/manage/message-list';
        $.ajax({
            url:url,
            type:'post',
            data: form,
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
</script>
