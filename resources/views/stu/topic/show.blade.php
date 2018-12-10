<div class="col-md-9" >
    <script>
        $(document).ready(function () {
            $('[id=read]').click(function () {
                htmlobj = $.ajax(
                    {

                        type: "GET",
                        url: this.href,
                        success: function () {
                            $("html,body").animate({scrollTop: 0}, 800);
                            var data = htmlobj.responseText;
                            $('#home-content').empty();
                            $("#home-content").html(htmlobj.responseText);
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            });
        });
    </script>
    <style>
        img{
            height: 100%;
            width: 100%;
        }
    </style>

    <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">查看详细</h3>

        <div class="box-tools pull-right">
            <a href=" {{url()->previous()}} " class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                        class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                        class="fa fa-chevron-right"></i></a>
        </div>
    </div>
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3>{{$topic->title}}</h3>
            <h5>{{$topic->sender->email}}
                <span class="mailbox-read-time pull-right">{{\Carbon\Carbon::parse($topic->created_at)->diffForHumans()}}</span>
            </h5>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body"
                        title="删除">
                    <i class="fa fa-trash-o"></i></button>
            </div>
            <!-- /.btn-group -->
            <a type="button" class="btn btn-default btn-sm" href="{{route('topics.edit',$topic->id)}}" data-toggle="tooltip" title="编辑" id="read">
                <i class="fa fa-edit"></i></a>
        </div>
        <div class="mailbox-read-message" >
            {!! $topic->content !!}
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <ul class="mailbox-attachments clearfix">
            @if($topic->att_name)
                <li>
                    <span class="mailbox-attachment-icon"><i class="fa fa-file"></i></span>

                    <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-file"></i> {{ $topic->att_name }}</a>
                        <span class="mailbox-attachment-size">
                            附件下载<a href="{{ $topic->att_url}}" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                    </div>
                </li>
            @endif


        </ul>
    </div>
    @if($topic->can_reply)
        <div class="reply-box">
            <form action="{{route('reply.store')}}" method="POST" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                <div class="form-group">
                    <div class="form-group">
                        <div id="editer">
                            <p>欢迎使用 <b>stu系统</b></p>
                        </div>
                        <textarea id="content" hidden="hidden" name="content"></textarea>
                        <script type="text/javascript" src="{{ asset('admin/wangEditor.min.js') }}"></script>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i>回复</button>
            </form>
            <script type="text/javascript">
                var E = window.wangEditor
                var editor = new E('#editer')
                editor.customConfig.uploadFileName = 'myfile'
                editor.customConfig.uploadImgServer = '/editor_upload?_token={{csrf_token()}}';
                var $text1 = $('#content')
                editor.customConfig.onchange = function (html) {
                    // 监控变化，同步更新到 textarea
                    $text1.val(html)
                }
                editor.create()
                $text1.val(editor.txt.html())
            </script>
        </div>
        <hr>
        @forelse ($topic->replies as $reply)
            <div class="mailbox-read-message">
                <div class="item">
                    <div class=" media"  name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
                        <div class="avatar pull-left">
                            <a href="{{ route('users.show', [$reply->user_id]) }}">
                                <img class="media-object img-thumbnail" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos">
                            <div class="media-heading">
                                <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
                                    {{ $reply->user->name }}
                                </a>
                                <span> •  </span>
                                <span class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

                                {{-- 回复删除按钮 --}}
                                <span class="meta pull-right">
                                <a title="删除回复">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </span>
                            </div>
                            <div class="reply-content">
                                {!! $reply->content !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        @empty
            <div class="mailbox-read-message">
                <div class="item">
                    <div class=" media"  name="reply" id="reply">
                        <div class="avatar pull-left">
                            <a href="">
                                <img class="media-object img-thumbnail" alt="系统" src="/storage/uploads/images/default.jpg"  style="width:48px;height:48px;"/>
                            </a>
                        </div>

                        <div class="infos">
                            <div class="media-heading">
                                <a href="" title="系统：">
                                    系统：
                                </a>
                                <span> •  </span>
                                <span class="meta" title="时间">00:00</span>

                            </div>
                            <div class="reply-content">
                                暂无回复哦
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        @endforelse
    @endif

    {{--@if($topic->)--}}
    {{--@endif--}}
</div>
</div>
