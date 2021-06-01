@extends('admin.layout.base')

@section('page-css')
    <style>
        @media (min-width: 576px){
            .modal-dialog {
                max-width: 600px;
                margin: 15% auto;
            }
        }

    </style>


@endsection

@section('content')
    <input type="hidden" value="{{json_encode($characters)}}" id="characters">
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">CSVインポート</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">CSVインポート</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">キャラ基本情報</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">キャラ選択</label>
                                    <select name="character_id" class="form-control custom-select" required>
                                        <option value="" selected></option>
                                        @for($i = 0; $i < count($characters); $i++)
                                            <option value="{{$characters[$i]['id']}}">{{$characters[$i]['unique_id']}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">名称</label>
                                    <input type="text" class="form-control" name="name" placeholder="名称">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">生年月日</label>
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
                                    <label class="form-label">削減ポイント</label>
                                    <input type="number" class="form-control" name="decreasing_point" placeholder="削減ポイント">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">プロファイル画像</label>
                                    {{--                                    <div class="preview" style="margin: 20px;">--}}
                                    {{--                                        <img id="photo-preview" src="" alt="no_img" style=" width: 100px">--}}
                                    {{--                                    </div>--}}
                                    <div class="d-flex" id="profile_img" style="width: 100px;">
                                        <img class="" src="{{asset('img/org.jpg')}}" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group" style="width: 50% !important;">
                                    <label class="form-label">性別</label>
                                    <select name="gender" class="form-control custom-select">
                                        <option value="0">男性</option>
                                        <option value="1">女性</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">メッセージ *</label>
                                    <textarea class="form-control" name="description" rows="12" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="form-label">CSVファイル</label>
                                    <button id="img_add" class="" onclick="openFile()" style="">ファイル選択</button>
                                    <input type="file" class="d-none" id="csv_file">
                                    <label class="d-none" id="file_label"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <div class="d-flex">
                            <button id="btn_submit" class="btn btn-primary mr-auto" data-toggle="modal" data-target="#messageModal" disabled>インポート</button>
                        </div>
                    </div>
                </div>
{{--                <form action="{{url('/manage/csv-import')}}" method="post" enctype="multipart/form-data" name="send" class="card" id="validation_form">--}}
{{--                    @csrf--}}

{{--                </form>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">CSVデータ形式</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap table-primary" >
                                            <tbody>
                                                <tr>
                                                    <th>A列</th>
                                                    <td>名前</td>
                                                    <td>さき</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>B列</th>
                                                    <td>アドレス</td>
                                                    <td>migikatasagarix@yahoo.co.jp</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>C列</th>
                                                    <td>電話番号</td>
                                                    <td>8045871255</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>D列</th>
                                                    <td>年齢</td>
                                                    <td>46</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>E列</th>
                                                    <td>誕生日</td>
                                                    <td>19800506</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>F列</th>
                                                    <td>都道府県</td>
                                                    <td>東京都</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>G列</th>
                                                    <td>性別</td>
                                                    <td>女性</td>
                                                    <td></td>
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
    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/manage/csv-import')}}" method="post" enctype="multipart/form-data" name="send" class="card" id="validation_form">
                        @csrf
                        <div class="form-group">
                            <label for="form_character_id" class="form-control-label">Recipient:</label>
                            <input type="text" class="form-control" id="form_character_id" name="ch_id">
                        </div>

                        <div class="form-group d-flex">
                            <div class="mr-1">
                                <button id="btn_name" class="btn btn-primary mr-auto">NAME</button>
                            </div>
                            <div class="mx-1">
                                <button id="btn_mail" class="btn btn-primary mr-auto">MAIL</button>
                            </div>
                            <div class="mx-1">
                                <button id="btn_phone" class="btn btn-primary mr-auto">PHONE</button>
                            </div>
                            <div class="mx-1">
                                <button id="btn_age" class="btn btn-primary mr-auto">AGE</button>
                            </div>
                            <div class="mx-1">
                                <button id="btn_birth" class="btn btn-primary mr-auto">BIRTH</button>
                            </div>
                            <div class="mx-1">
                                <button id="btn_area" class="btn btn-primary mr-auto">PREF</button>
                            </div>
                            <div class="ml-1">
                                <button id="btn_gender" class="btn btn-primary mr-auto">SEX</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Message:</label>
                            <textarea class="form-control" id="message_text" name="message_text" rows="10"></textarea>
                        </div>
                        <input class="d-none" name="csv_file" id="form_csv_file" type="file">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-primary" id="form_submit">送信</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript">
        $(document).ready(function() {
            var characters = JSON.parse($('#characters').val());
            $('form').submit(function(e) {
                e.preventDefault();
                // or return false;
            });
            $('[name=character_id]').change(function () {
                if($("#form_csv_file")[0].files.length > 0 && $(this).val()){
                    $('#btn_submit')[0].disabled = false;
                    var sel_txt = $(this)[0].options[$(this)[0].selectedIndex].text;
                    $('#form_character_id').val(sel_txt)
                }
                else{
                    $('#btn_submit')[0].disabled = true;
                }
            })

            $('#btn_name').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%username%';
                $('#message_text').val(a_txt);
            })
            $('#btn_mail').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%usermail%';
                $('#message_text').val(a_txt);
            })
            $('#btn_phone').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%userphone%';
                $('#message_text').val(a_txt);
            })
            $('#btn_age').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%userage%';
                $('#message_text').val(a_txt);
            })
            $('#btn_birth').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%userbirth%';
                $('#message_text').val(a_txt);
            })
            $('#btn_area').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%userpref%';
                $('#message_text').val(a_txt);
            })
            $('#btn_gender').click(function () {
                var o_txt = $('#message_text').val();
                var a_txt = o_txt + '%usersex%';
                $('#message_text').val(a_txt);
            })

            $('#form_submit').click(function () {
                document.send.submit();
            })

            $('#btn_submit').click(function () {
                // var forms = document.getElementById('validation_form');
                // forms.classList.add('was-validated');
                // if (forms.checkValidity() === true) {
                //     document.send.submit();
                // }
                var sel_txt = $('[name=character_id]')[0].options[$('[name=character_id]')[0].selectedIndex].text;
                $('#form_character_id').val(sel_txt)

            })
            $('[name="character_id"]').change(function () {
                for(var i = 0; i < characters.length; i++){
                    if(characters[i]['id'] == $(this).val()){
                        $('[name=name]').val(characters[i]['name']);
                        $('[name=gender]').val(characters[i]['gender']);
                        $('[name=birthday]').val(characters[i]['birth']);
                        $('[name=decreasing_point]').val(characters[i]['decreasing_point']);
                        $('[name=description]').val(characters[i]['description']);
                        $('[name=image]')[0].src = characters[i]['image'];
                    }
                }
            })
        });
        function openFile() {
            $('#form_csv_file').trigger('click');
        }

        $("#form_csv_file").on("change", function(){
            if (this.files && this.files[0]) {

                let label1 = $('#file_label');
                label1.removeClass('d-none');

                label1[0].textContent = this.files[0].name;
                $("#form_csv_file")[0].files = this.files;
                console.log($("#form_csv_file")[0].files);
                if($('[name=character_id]').val()){
                    $('#btn_submit')[0].disabled = false;
                }
                else{
                    $('#btn_submit')[0].disabled = true;
                }
                // console.log($("#form_csv_file")[0].files)
                //input1[0].files = e.target.files;
            }
        })
        function deleteImg() {
            $('.preview').hide();
            $('#photo-preview').attr('src',"");
            $('#photo').val('');
        }
    </script>
@endsection
