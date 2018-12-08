<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-warning">{{$message_number}}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">你有{{$message_number}} 条回复未读</li>
    <li>
    @forelse($messages as $message)
            <ul class="menu">
                <li>
                    <i class="fa fa-users text-aqua">
                        <a href="{{ route('users.show', $message->data['user_id']) }}">{{ $message->data['user_name'] }}</a>
                        评论了
                        <a href="{{ $message->data['topic_link'] }}">{{ $message->data['topic_title'] }}</a>
                    </i>
                </li>
            </ul>
    @empty
        <li><a href="#">
                <div class="pull-left">
                    暂无
                </div>
            </a>
    @endforelse
        </li>
        <!-- end message -->

        <li class="footer"><a href="{{route('messages.index',['tab'=>'reply'])}}">查看详情</a></li>
</ul>
