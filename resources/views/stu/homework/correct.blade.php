<script>
    $(document).ready(function () {
        $('[id=read]').click(function () {
            htmlobj = $.ajax(
                {

                    type: "GET",
                    url: this.href,
                    success: function () {
                        $('#home-content').empty();
                        $("#home-content").html(htmlobj.responseText);
                    },
                    error: function () {
                        alert('获取失败联系管理员')
                    }

                });
            return false;
        });
        $('[id=read1]').click(function () {
            htmlobj = $.ajax(
                {
                    type: "GET",
                    url: this.href,
                    success: function () {
                        $('#myModal').empty();
                        $("#myModal").html(htmlobj.responseText);
                    },
                    error: function () {
                        alert('获取失败联系管理员')
                    }

                });
            return true;
        });

    });

</script>

<div class="col-md-9" id="home-content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">批改作业</h3>

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
                        <th>作业标题</th>
                        <th>内容（部分）</th>
                        <th>文件下载</th>
                        <th>提交时间</th>
                        <th>分数</th>
                        <th>发布人</th>
                        <th>操作</th>
                    </tr>
                    @forelse ($stuhomeworks as $stuhomework)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-subject"><b><a
                                            href="{{route('homework.show',$stuhomework->homework)}}"
                                            id="read">{{$stuhomework->homework->title}}</a></b>
                            <td class="mailbox-subject">
                                <b><a href="{{route('stuhomework.show',$stuhomework)}}" id="read">
                                        {!!  mb_substr(strip_tags($stuhomework->content),0,30) !!}</a>
                                </b>
                            </td>
                            <td>
                                <a href="{{$stuhomework->attachment}}">{{ preg_replace("[.+/.+/]",'',$stuhomework->attachment) }}</a>
                            </td>
                            <td class="mailbox-date">{{\Carbon\Carbon::parse($stuhomework->created_at)->diffForHumans()}}</td>
                            <td id="grade{{$stuhomework->id}}">{{ $stuhomework->fraction }}</td>
                            <td>{{$stuhomework->poster->email}} [{{$stuhomework->poster->name}}]</td>
                            <td>
                                <a href=" {{route('stuhomework.show',$stuhomework)}}"
                                   class="label label-warning  btn-sm btn-primary btn-block" data-toggle="modal"
                                   data-target="#myModal" id="read1">查看详情</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>暂无作业</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 模态框（Modal） -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
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
                    {{$stuhomeworks->links()}}
                </div>
            </div>
        </div>
    </div>
</div>