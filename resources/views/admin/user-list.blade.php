<div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap table-primary" id="user_table">
        <thead class="bg-primary text-white">
        <tr>
            <th class="text-white" width="5%">
                <label class="custom-control custom-checkbox mb-0">
                    <input type="checkbox" class="custom-control-input header-checkbox"
                           name="">
                    <span class="custom-control-label"></span>
                </label>
            </th>
            <th class="text-white" width="15%">ID</th>
            <th class="text-white" width="15%">名称</th>
            <th class="text-white" width="10%">性別</th>
            <th class="text-white" width="10%">年齢</th>
            <th class="text-white" width="10%">ポイント</th>
            <th class="text-white" width="15%">最終ログイン日時</th>
            <th class="text-white" width="15%">メールアドレス</th>
            <th width="5%"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td scope="row">
                    <label class="custom-control custom-checkbox mb-0">
                        <input type="checkbox" class="custom-control-input tr-checkbox"
                               name="" value="{{$member->id}}">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <th><a href="{{url('/manage/member-detail/'. $member->id)}}">{{$member->unique_id}}</a>
                </th>
                <td>{{$member->name}}</td>
                <td>{{$member->gender}}</td>
                <td>{{$member->age}}歳</td>
                <td>{{$member->point}}pt</td>
                <td>{{$member->last_login}}</td>
                <td>{{$member->email}}</td>
                <td>
                    <input type="hidden" value="{{$member->id}}">
                    <button class="member_delete btn btn-primary ml-auto">削除</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    <div class="float-right">--}}
{{--        {!! $members->appends($pagination_params)->render() !!}--}}
{{--    </div>--}}
</div>
