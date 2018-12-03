        <div class="col-md-9" id="home-content">
@include('layouts.error')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">发送一条私信</h3>
            </div>
            <form action="{{route('messages.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <select multiple class="form-control" name="user_id">
                            <option>请选择接收人物</option>
                            @foreach($datas as $data)
                                <option>-------{{ $data->name }}下成员</option>
                                @foreach($data->student as $user)
                                    @if($user->id != \Illuminate\Support\Facades\Auth::id())
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <div id="editer">
                            <p>欢迎使用 <b>stu系统</b>，这里写要发送的内容</p>
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
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        {{--<button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>--}}
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> 发送</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> 清空</button>
                </div>
            </form>
        </div>
    </div>
