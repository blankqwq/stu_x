<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>作业名</th>
        <th>分数</th>
        <th>创建时间</th>
    </tr>
    </thead>
    <tbody>
    @foreach($datas as $data)
        <tr>
            <?php $s=$data->stuhomeworks->where('homework_id',$hid)->first()?>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{$homework}}</td>
            <td>{{ isset($s->fraction)? $s->fraction:'未交'}}</td>
            <td>{{isset($s->created_at)? $s->created_at:'未交'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>