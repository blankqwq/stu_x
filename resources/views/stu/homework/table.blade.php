@forelse ($homeworks as $homework)
    <tr>
        <td><input type="checkbox"></td>
        <td class="mailbox-subject"><b><a href="{{route('homework.show',$homework)}}"
                                          id="read">{{ $homework->title }}</a></b></td>
        <td class="mailbox-name"> {!!  mb_substr(strip_tags($homework->content),0,30) !!} </td>
        <td class="mailbox-attachment">{{\Carbon\Carbon::parse($homework->start_time)->diffForHumans()}}-
            &nbsp;-{{\Carbon\Carbon::parse($homework->stop_time)->diffForHumans()}}</td>

        <td class="mailbox-date">{{$homework->created_at->diffForHumans()}}</td>
        <td>{{$homework->publisher->email}}</td>
        <td>{{ $homework->posters_count }}</td>
        <td>
            <a href="{{route('homework.show',$homework)}}" class="label label-success  btn-sm"
               role="button" id="read">查看</a>

            @can('update',$homework)
                <a href="{{route('homework.correct',$homework)}}" class="label label-danger  btn-sm"
                   role="button" id="read">批改</a>
                <a href="{{route('homework.edit',$homework)}}" class="label label-warning  btn-sm"
                   role="button" id="read">修改</a>
            @endcan

        </td>
    </tr>
@empty
    <tr>
        <td>暂无作业</td>
    </tr>
@endforelse