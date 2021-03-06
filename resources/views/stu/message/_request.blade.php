<div class="col-md-9" id="home-content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">请求通知</h3>

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
                <!-- Check all button -->
                <script>
                    $(document).ready(function () {
                        $('[id=func]').click(function () {
                            htmlobj = $.ajax(
                                {
                                    type: "POST",
                                    url: this.href,
                                    data:"_token={{ csrf_token() }}",
                                    success: function () {
                                        if (htmlobj.responseText=='1'){
                                            alert('操作成功')
                                            location.reload()
                                        }
                                    },
                                    error: function () {
                                        alert('操作失败')
                                    }

                                });
                            return false;
                        });
                    });
                </script>

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
                                申请加入您的班级
                                <a href="{{ route('classes.show',$notification->data['class_id']) }}">{{ $notification->data['class_name'] }}</a>

                                <span class="meta pull-right" title="{{ $notification->created_at }}">
                                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                            </div>
                            <div class="box-body">
                                {{$notification->data['token'] }}
                            </div>
                            @if($notification->read_at==null)

                            <div class="box-footer">
                                <a href="{{route('classuser.agree',[$notification->data['classuser_id'],$notification->id])}}" id="func"><span
                                            class="label label-success">通过</span></a>
                                <a href="{{route('classuser.disagree',[$notification->data['classuser_id'],$notification->id])}}" id="func"><span
                                            class="label label-danger">不通过</span></a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(isset($notifications))
                    {{$notifications->appends(['tab'=>'request'])->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
