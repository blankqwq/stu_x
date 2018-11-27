<div class="box">
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
                            $('#class-content').empty();
                            $("#class-content").html(htmlobj.responseText);
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            });
        });
    </script>
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ $classe->avatar }}"
             alt="未找到图片">
        <h3 class="profile-username text-center">班级名:{{ $classe->name }}</h3>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>创建时间：</b> <a class="pull-right">{{ $classe->created_at }}</a>
            </li>
            <li class="list-group-item">
                <b>创建者</b> <a class="pull-right" href="/users/{{ $classe->creator->id }}"
                              id="read">{{ $classe->creator->email }}</a>
            </li>


            <li class="list-group-item">
                <b>审核人</b> <p class="pull-right">
                    @if(\App\Models\User::find($classe->user_allow))
                        {{ \App\Models\User::find($classe->user_allow)->first()->name }}
                    @endif</p>
            </li>

            <li class="list-group-item">
                <b>类型</b>
                    <a class="pull-right"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$classe->type->category}}</a>
            </li>
            <li class="list-group-item">
                <b>是否需要密码</b> <a class="pull-right">
                    @if($classe->password)
                        需要
                    @else
                        不需要
                    @endif</a>
            </li>
            <li class="list-group-item">
                <b>是否需要认证</b> <a class="pull-right">
                    @if($classe->verification!=0)
                        需要
                    @else
                        不需要
                    @endif</a>
            </li>
            <li class="list-group-item">
                <b>加入班级</b> <a class="pull-right" href="/join/class/{{ $classe->id}}">点击申请</a>
            </li>
        </ul>
        @can('update',$classe)
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">修改班级资料
            </button>
            <!-- 模态框（Modal） -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">修改用户资料</h4>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('classes.update',$classe->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="form-group">
                                    <div class="col-xs-12 text-center">
                                        <img class="profile-user-img img-responsive img-circle"
                                             src="{{ $classe->avatar }}"
                                             alt="未找到图片">
                                        <label>班级图片</label>
                                        <input type="file" name="avatar" id="pic" class="center-block"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>班级名</label>
                                    <input type="text" class="form-control" name="name" placeholder="班级名称"
                                           value="{{ $classe->name }}">
                                </div>
                                <div class="form-group">
                                    <label>加入密码</label>
                                    <input type="text" class="form-control" name="password" placeholder="需要则写入，不需要就不用写"
                                           value="{{ $classe->password }}">
                                </div>
                                <div class="form-group">
                                    <label>是否需要认证：</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="verification" id="inlineRadio1" value="1"
                                               @if($classe->verification =="1")
                                               checked
                                                @endif> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="verification" id="inlineRadio2" value="0"
                                               @if($classe->verification =="0")
                                               checked
                                                @endif> 否
                                    </label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                    </button>
                                    <button type="submit" class="btn btn-primary">提交更改</button>
                                </div>
                            </form>
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</form>--}}
                        @endcan
                        </div><!-- /.modal -->
                    </div>

                </div>
            </div>
    </div>
    <!-- /.box-body -->
</div>