<div class="col-md-9">

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">查看详细</h3>

        <div class="box-tools pull-right">
            <a href="{{url()->previous()}}" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                        class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                        class="fa fa-chevron-right"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3>{{$homework->title}}</h3>
            <h5>{{$homework->publisher->email}}
                <span class="mailbox-read-time pull-right">{{\Carbon\Carbon::parse($homework->created_at)->diffForHumans()}}</span>
            </h5>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
                <button class="btn btn-github center-block" data-toggle="modal" data-target="#myModal">
                    提交作业
                </button>
            </div>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            {!! $homework->content !!}
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- 按钮触发模态框 -->

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        提交作业咯
                    </h4>
                </div>
                <form action="{{ route('stuhomework.store',$homework) }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="editer">
                                <p>这里写要提交的内容 <b>stu系统</b></p>
                            </div>
                            <textarea id="content" hidden="hidden" name="content"></textarea>
                            <script type="text/javascript" src="{{ asset('admin/wangEditor.min.js') }}"></script>
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
                                // 初始化 textarea 的值
                                $text1.val(editor.txt.html())
                            </script>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> 附件
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">仅仅只能zip文件</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                        </button>
                        <button type="submit" class="btn btn-primary">
                            提交作业
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    @include('stu.homework._stuhomework',['stuhomeworks'=>$homework->posters->where('user_id',$user->id)])

</div>
</div>