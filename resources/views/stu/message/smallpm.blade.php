<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success">{{$message_number}}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">你有{{$message_number}} 条私信未读</li>
    <li>
        @forelse($messages as $message)
            <ul class="menu">
                <li><!-- start message -->
                    <a href="#">
                        <a href="{{ route('messages.index', ['tab'=>'pm']) }}">{{ $message->data['user_name'] }}发来一条私信</a>

                    </a>
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
        <li class="footer"><a href="{{route('messages.index',['tab'=>'pm'])}}">查看详情</a></li>
</ul>