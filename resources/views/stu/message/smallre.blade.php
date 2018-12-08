<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-flag-o"></i>
    <span class="label label-success">{{$message_number}}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">你有{{$message_number}} 条请求未读</li>
    <li>
        @forelse($messages as $message)
            <ul class="menu">
                <li><!-- Task item -->
                    <a href="#">
                        <a href="{{ route('messages.index', ['tab'=>'request']) }}">{{ $message->data['user_name'] }}
                            申请加入您的班级
                            {{ $message->data['class_name'] }}</a>
                    </a>
                </li>
            </ul>
    @empty
        <li><a href="#">
                <div class="pull-left">
                    暂无
                </div>
            </a></li>
    @endforelse
    <li class="footer"><a href="{{route('messages.index',['tab'=>'request'])}}">查看详情</a></li>
</ul>

