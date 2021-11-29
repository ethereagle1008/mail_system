<div class="table-responsive">
    <table class="table card-table table-center text-nowrap table-primary" id="code_table">
        <thead  class="bg-primary text-white">
        <tr>
            <th>広告コード</th>
            <th>広告媒体</th>
            <th>登録数</th>
            <th>接近数</th>
        </tr>
        </thead>
        <tbody>
        @foreach($codes as $member)
            <tr>
                <td>{{$member->code}}</td>
                <td>{{$member->media_type}}</td>
                <td>{{$member->register}}</td>
                <td>{{$member->access}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
