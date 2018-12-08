<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">最近需要交的作业</h3>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th>标题</th>
                        <th>内容（部分）</th>
                        <th>开始时间--结束时间</th>
                        <th>发布时间</th>
                        <th>发布人</th>
                        <th>操作</th>
                    </tr>
                    @forelse ($homeworks as $homework)
                        <tr>
                            <td class="mailbox-subject"><b><a href="{{route('homework.show',$homework)}}"
                                                              id="read">{{ $homework->title }}</a></b></td>
                            <td class="mailbox-name"> {!!  mb_substr(strip_tags($homework->content),0,30) !!} </td>
                            <td class="mailbox-attachment">{{\Carbon\Carbon::parse($homework->start_time)->diffForHumans()}}-
                                &nbsp;-{{\Carbon\Carbon::parse($homework->stop_time)->diffForHumans()}}</td>

                            <td class="mailbox-date">{{$homework->created_at->diffForHumans()}}</td>
                            <td>{{$homework->publisher->email}}</td>
                            <td>{{ $homework->posters_count }}</td>
                            <td>
                                <a href="{{route('classes.show',[$homework->class_id,'tab'=>'homework'])}}" class="label label-success  btn-sm"
                                   role="button">查看</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>暂无作业</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer no-padding">
            <div class="mailbox-controls">

                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
</div>