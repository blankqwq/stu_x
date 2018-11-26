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

<div class="col-md-9" id="home-content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">作业表</h3>

            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Search ">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                            class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                    </button>

                </div>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>

            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th>#</th>
                        <th>标题</th>
                        <th>内容（部分）</th>
                        <th>开始时间- &nbsp;-结束时间</th>
                        <th>发布时间</th>
                        <th>发布人</th>
                        <th>是否提交</th>
                        <th>分数</th>
                    </tr>
                    @forelse ($homeworks as $homework)
1
                    @empty
                        <tr>
                            <td>暂无作业</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer no-padding">
            <div class="mailbox-controls">
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                            class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i>
                    </button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                    {{$homeworks->links()}}
                </div>
            </div>
        </div>
    </div>
</div>