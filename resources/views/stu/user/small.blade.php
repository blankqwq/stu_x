<div class="box">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ $one->avatar }}"
             alt="User profile picture">

        <h3 class="profile-username text-center">姓名：{{ $one->name }}</h3>

        <p class="text-muted text-center">个性签名：{{ $one->sign }}</p>

        <p class="text-muted text-center">性别：{{ $one->sex }}</p>

        <p class="text-muted text-center">邮箱地址：{{ $one->email }}</p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>平均分</b> <a class="pull-right">分数</a>
            </li>
            <li class="list-group-item">
                <b>已加入的班级</b> <a class="pull-right">数量</a>
            </li>
            <li class="list-group-item">
                <b>Friends</b> <a class="pull-right">13,287</a>
            </li>
        </ul>
        @if(\Illuminate\Support\Facades\Auth::id() === $one->id or \Illuminate\Support\Facades\Auth::user()->can('manage-user'))
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">修改资料</button>
            <!-- 模态框（Modal） -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">

                    <form action="{{ route('users.update', $one) }}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" value="{{$one->id}}" name="id">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">修改用户资料</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <div class="col-xs-12 text-center">
                                        <img src="{{ $one->avatar }}" id="avatarImg"
                                             class="profile-user-img img-responsive img-circle"/>
                                        <input type="file" name="avatar" id="pic" class="center-block"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">姓名</label>
                                    <input type="text" class="form-control" id="name" placeholder="姓名" name="name"
                                           value="{{ $one->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="sign">个性签名</label>
                                    <input type="text" class="form-control" id="sign" placeholder="个性签名" name="sign"
                                           value="{{ $one->sign }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">老密码</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="old_password"
                                           placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">新密码</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="new_password"
                                           placeholder="Password">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                    </button>
                                    <button type="submit" class="btn btn-primary">提交更改</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div><!-- /.modal -->
            </div>

    </div>
    <!-- /.box-body -->
</div>