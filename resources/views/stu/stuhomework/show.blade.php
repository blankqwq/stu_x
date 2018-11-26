<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">批改小窗</h4>
        </div>
        <div class="modal-body">

            <form action="{{route('stuhomework.update',$stuhomework)}}" method="post">
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
                    <input type="text" class="form-control" name="fraction"
                           value="{{ $stuhomework->fraction }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                    </button>
                    <button type="submit" class="btn btn-primary">提交更改</button>
                </div>
            </form>
        </div><!-- /.modal -->

    </div>
</div>
