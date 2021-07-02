<div class="table-responsive">
    <table id="user-list" class="table card-table table-vcenter text-nowrap table-primary" >
        <thead  class="bg-primary text-white">
        <tr >
            <th class="text-white">ID</th>
            <th class="text-white">名称</th>
            <th class="text-white">性別</th>
            <th class="text-white">年齢</th>
            <th class="text-white">ポイント</th>
            <th class="text-white">最終ログイン日時</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <th scope="row"><a href="{{url('/manage/member-detail/'. $member->id)}}">{{$member->unique_id}}</a> </th>
                <td>{{$member->name}}</td>
                <td>{{$member->gender}}</td>
                <td>{{$member->age}}歳</td>
                <td>{{$member->point}}pt</td>
                <td>{{$member->last_login}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    <div class="float-right">--}}
{{--        {!! $members->appends($pagination_params)->render() !!}--}}
{{--    </div>--}}
</div>
<script type="text/javascript">
    var home_path = $("#home_path").val();
    // $(document).ready(function () {
    //     $('.page-link').click(function (e) {
    //         e.preventDefault();
    //         var rel = $(this).attr('href')
    //         var rel_arr = rel.split('=');
    //         var page = rel_arr[rel_arr.length-1];
    //         getUserList(page);
    //     })
    //
    // })
    //
    // function getUserList(page) {
    //     var token = $("meta[name='_csrf']").attr("content");
    //     var form = $('#auto')[0]; // You need to use standard javascript object here
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': token
    //         }
    //     });
    //
    //     var url = home_path + '/manage/select-users';
    //     $.ajax({
    //         url:url,
    //         type:'post',
    //         data: {
    //             unique_id : $('[name="unique_id[]"]').val(),
    //             user_name : $('[name="user_name"]').val(),
    //             gender : $('[name="gender"]').val(),
    //             start_age : $('[name="start_age"]').val(),
    //             end_age : $('[name="end_age"]').val(),
    //             start_count : $('[name="start_count"]').val(),
    //             end_count : $('[name="end_count"]').val(),
    //             start_money : $('[name="start_money"]').val(),
    //             end_money : $('[name="end_money"]').val(),
    //             start_price : $('[name="start_price"]').val(),
    //             end_price : $('[name="end_price"]').val(),
    //             start_point : $('[name="start_point"]').val(),
    //             end_point : $('[name="end_point"]').val(),
    //             start_login : $('[name="start_login"]').val(),
    //             end_login : $('[name="end_login"]').val(),
    //             page : page
    //         },
    //         success: function (response) {
    //             $("#select_user").html(response);
    //             $('html, body').animate({
    //                 scrollTop: $("#btn_search").offset().top - $("#top_header").height() - 20
    //             });
    //         },
    //         error: function () {
    //         }
    //     });
    // }
</script>
