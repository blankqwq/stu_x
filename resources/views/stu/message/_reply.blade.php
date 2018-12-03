<div class="col-md-9" id="home-content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">回复通知</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search ">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
            <!-- /.box-tools -->
        </div>
        <div class="box-body no-padding">
            <div class="mailbox-controls">

            </div>
            <div class="table-responsive mailbox-messages">
                @foreach($notifications as $notification)

                    <div class="media">
                        <div class="avatar pull-left">
                            <a href="{{ route('users.show', $notification->data['user_id']) }}">
                                <img class="media-object img-thumbnail" alt="{{ $notification->data['user_name'] }}" src="{{ $notification->data['user_avatar'] }}"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos">
                            <div class="box-header">
                                <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
                                评论了
                                <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>

                                <span class="meta pull-right" title="{{ $notification->created_at }}">
                                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                            </div>
                            <div class="box-body">
                                {!! $notification->data['reply_content'] !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(isset($notifications))
                    {{$notifications->appends(['tab'=>'reply'])->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
