@extends('layouts.admin')
@section('users','active')
@section('users-manage','active')
@section('content')

    <section class="content-header">
        <h1>
            用户
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">users/me</li>
        </ol>
    </section>
    <script>
        $(document).ready(function () {
            $('[id=read]').click(function () {
                htmlobj = $.ajax(
                    {
                        type: "GET",
                        url: this.href,
                        success: function () {
                            $('#users-content').empty();
                            $("#users-content").html(htmlobj.responseText);
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            });
            $('[id=send]').click(function () {
                htmlobj2 = $.ajax(
                    {
                        type: "POST",
                        url: this.href,
                        data:{'_token':'{{csrf_token()}}'},
                        success: function () {
                            console.log('ok')
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            })
            $('[id=dele]').click(function () {
                htmlobj2 = $.ajax(
                    {
                        type: "POST",
                        url: this.href,
                        data:{'_token':'{{csrf_token()}}','_method':'delete'},
                        success: function () {
                            console.log('ok')
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            })
        });
    </script>


    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">用户表</h3>
                        <div class="box-tools">
                            <form action="/users/search" method="post">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    {{ csrf_field() }}
                                    <input type="text" name="search" class="form-control pull-right"
                                           placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    @if(isset($id) && $id!==null)
                        <form action="{{route('classuser.destroy',$id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                    @endif
                    <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>email</th>
                                    <th>创建时间</th>
                                    <th>更新事件</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($users as $one)
                                    <tr>
                                        <td>@if($user->id!==$one->id)
                                                <input type="checkbox" value="{{ $one->id }}" name="ids[]">
                                            @endif</td>
                                        <td>{{ $one->name }}</td>
                                        <td>{{ $one->sex }}</td>
                                        <td>{{ $one->email }}</td>
                                        <td>{{ $one->created_at }}</td>
                                        <td>{{ $one->updated_at }}</td>
                                        <td><a href="{{route('users.small',$one->id)}}" id="read"><span
                                                        class="label label-warning">查看</span></a>
                                            @if(isset($id) && $id!==null)
                                            @role(config('code.role').'|class'.$id)
                                            @if(!$one->hasRole('|class'.$id))
                                            <a href="{{route('pers.give',[$id,$one->id])}}" id="send">
                                                <span class="label label-success">设置为管理权限</span>
                                            </a>
                                            @else
                                                @if(!($user->id === $one->id))
                                                <a href="{{route('pers.del',[$id,$one->id])}}" id="dele">
                                                    <span class="label label-danger">取消管理员权限</span>
                                                </a>
                                                @endif
                                            @endif

                                            @endrole
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if(!$users)
                                    未找到任何信息
                                @endif

                            </table>
                            <div class="box-footer">
                                @if(isset($id))
                                    @role(config('code.role').'|class'.$id)
                                    <button class="btn btn-google btn-sm ">删除用户</button>
                                    @endrole

                                @endif
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    {{ $users->links() }}
                                </ul>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4" id="users-content">

            </div>

        </div>


    </section>



@endsection
