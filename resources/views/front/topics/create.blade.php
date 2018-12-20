@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('editor/css/editormd.css') }}">

@section('content')
    <div class="container">
        <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-header with-border">
                        <h3 class="panel-collapse">编辑发送</h3>
                        <hr>
                    </div>
                    @include('layouts.error')
                    <form action="{{route('topics.store',0)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <input class="form-control" placeholder="To:" value="To:全体人员" disabled>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="标题" name="title">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="排序等级" name="level">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="type_id">
                                    <option>请选择类型</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <span>能否回复:</span>
                                <label class="control-label">
                                    <input type="radio" name="can_reply" id="inlineRadio1" value="1"> 能
                                </label>
                                <label class="control-label">
                                    <input type="radio" name="can_reply"   id="inlineRadio2" value="0"> 否
                                </label>
                            </div>
                            <div class="form-group">

                                <script src="{{asset('editor/editormd.min.js')}}"></script>

                                    <div class="editormd" id="test-editormd">
                                        <textarea class="editormd-markdown-textarea" name="test-editormd-markdown-doc"></textarea>
                                        <textarea class="editormd-html-textarea" name="content"></textarea>
                                    </div>
                                <script type="text/javascript">
                                    $(function() {
                                        editormd("test-editormd", {
                                            width: "90%",
                                            height: 640,
                                            syncScrolling: "single",
                                            path: "/editor/lib/",
                                            saveHTMLToTextarea: true,
                                            imageUpload: true,
                                            imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                                            imageUploadURL: "/upload/image",
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> 附件
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                        </div>

                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> 发送</button>
                            </div>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> 清空</button>
                        </div>
                    </form>
                    <!-- /.box-footer -->
                </div>
            <!-- /. box -->
            </div>
         </div>



@endsection