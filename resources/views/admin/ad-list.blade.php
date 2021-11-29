<div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap table-primary" id="code_table">
        <thead class="bg-primary text-white">
        <tr>
            <th class="text-white" width="15%">広告コード</th>
            <th class="text-white" width="10%">媒体</th>
            <th class="text-white" width="10%">登録日</th>
        </tr>
        </thead>
        <tbody>
        @foreach($codes as $member)
            <tr>
                <td>{{$member->code}}</td>
                <td>{{$member->media_type}}</td>
                <td>{{$member->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{--    <div class="float-right">--}}
    {{--        {!! $members->appends($pagination_params)->render() !!}--}}
    {{--    </div>--}}
</div>
