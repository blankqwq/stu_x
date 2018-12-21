<div  id="home-content">

<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">作业表</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search ">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="mailbox-controls">

                <ul>
                    <li  class="btn btn-sm {{ active_class(if_query('users',null)) }}"
                        onclick="window.location.href='{{route('classes.show', [$classe->id, 'tab' => 'homework'])}}'">全部</li>
                @foreach($managers as $manager)
                    <li value="{{$manager->id}}" class="btn btn-sm {{ active_class(if_query('users', $manager->id)) }}"
                            onclick="window.location.href='{{route('classes.show', [$classe->id, 'tab' => 'homework','users'=>$manager->id])}}'">{{$manager->name}}</li>
                @endforeach
                </ul>

                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                    </button>

                </div>
                <button type="button" class="btn btn-default btn-sm">导出</button>

            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>标题</th>
                        <th>内容（部分）</th>
                        <th>开始时间- &nbsp;-结束时间</th>
                        <th>发布时间</th>
                        <th>发布人</th>
                        <th>已收到（份）</th>
                        <th>操作</th>
                    </tr>
                    @if(!isset($_GET['users']))
                        <?php
                        $homeworks=$homeworks->paginate(10)
                        ?>
                    @else
                        <?php
                        $homeworks=$homeworks->where('teacher_id',$_GET['users'])->paginate(10)
                        ?>
                    @endif

                    @forelse ($homeworks as $homework)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td class="mailbox-subject"><b><a href="{{route('homework.show',$homework)}}"
                                                                  id="read">{{ $homework->title }}</a></b></td>
                                <td class="mailbox-name"> {!!  mb_substr(strip_tags($homework->content),0,30) !!} </td>
                                <td class="mailbox-attachment">{{\Carbon\Carbon::parse($homework->start_time)->diffForHumans()}}-
                                    &nbsp;-{{\Carbon\Carbon::parse($homework->stop_time)->diffForHumans()}}</td>

                                <td class="mailbox-date">{{$homework->created_at->diffForHumans()}}</td>
                                <td>{{$homework->publisher->name}}</td>
                                <td>{{ $homework->posters_count }}</td>
                                <td>
                                    <a href="{{route('homework.show',$homework)}}" class="label label-success  btn-sm"
                                       role="button" id="read">查看</a>

                                    @can('update',$homework)
                                    <a href="{{route('homework.correct',$homework)}}" class="label label-danger  btn-sm"
                                       role="button" id="read">批改</a>
                                    <a href="{{route('homework.edit',$homework)}}" class="label label-warning  btn-sm"
                                       role="button" id="read">修改</a>
                                    <a href="{{route('homework.export',$homework)}}" class="label label-warning  btn-sm"
                                       role="button">导出</a>
                                    @endcan

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
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                            class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                    </button>
                </div>
                <button type="button" class="btn btn-default btn-sm">导出</button>
                <div class="pull-right">
                    {{$homeworks->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>