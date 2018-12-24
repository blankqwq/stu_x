<div class="modal-dialog">
    <script crossorigin="anonymous" integrity="sha384-kQAIwZYuvWpBWbD3nlb0ndKyiK0CEcuzCreus/gbkOCY7Bit00PCA51jKXbsCrM/" src="https://lib.baomitu.com/jquery.form/4.2.2/jquery.form.js"></script>
    <style>
        img{
            max-height: 100%;
            max-width: 100%;
        }
    </style>
    <script>
       function saveReport() {
           $("#dataform").ajaxSubmit(function(message) {
               $('#grade{{$stuhomework->id}}').html($('#afraction').val());
               alert('批改成功');
               $('#modelclose').click()
           });
           return false;
       }
    </script>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="modelclose">
                &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">批改小窗</h4>
        </div>
        <div class="modal-body">

            <form action="{{route('stuhomework.update',$stuhomework)}}" method="post" id="dataform" onsubmit="return saveReport()" >
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="form-group">
                    <label>内容</label>
                    <div>
                        {!!$stuhomework->content !!}
                    </div>
                </div>
                <div class="form-group">
                    <label>文件</label>
                    <p>
                        <a href="{{$stuhomework->attachment}}" target="_blank">{{ preg_replace("[.+/.+/]",'',$stuhomework->attachment) }}</a>
                    </p>
                </div>
                <div class="form-group">
                    <label>分数</label>
                    <input type="text" class="form-control" name="fraction" id="afraction"
                           value="{{ $stuhomework->fraction }}">
                </div>
                <div class="form-group">
                    <label>评语</label>
                    <div id="editer">
                        {!! $stuhomework->comment !!}
                    </div>
                    <textarea id="content" hidden="hidden" name="comment"> </textarea>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                    </button>
                    <button type="submit" class="btn btn-primary" >提交更改</button>
                </div>
            </form>
        </div>
    </div>
</div>
