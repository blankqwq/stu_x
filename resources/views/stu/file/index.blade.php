@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
            个人文件管理
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
                            $("html,body").animate({scrollTop: 0}, 800);
                            var data = htmlobj.responseText;
                            $('#users-content').empty();
                            $("#users-content").html(htmlobj.responseText);
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            });
        });
    </script>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$user->name}}用户文件</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <form action="/files/del" method="post">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>名称</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                @foreach($files as $file)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $file->id }}" name="ids[]">
                                        </td>
                                        <td>
                                            @if($file->type=='0')
                                                <a href="/files/{{$file->id}} "
                                                   class="glyphicon glyphicon-folder-open">&nbsp;&nbsp;{{ $file->name }}</a>
                                            @else
                                                <a href="{{$file->url}}" target="_blank"
                                                   class="glyphicon glyphicon-save-file">  {{ $file->name }}</a>
                                            @endif</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td><a href="/files/read/{{$file->id}}" id="read"><span
                                                        class="label label-warning">查看</span></a>
                                            @if($file->type!='0')
                                                <a href="{{$file->url}}" target="_blank">
                                                    <span class="label label-success glyphicon glyphicon-save-file">下载</span>
                                                    @endif
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>

                            <div class="box-footer">
                                <button class="btn btn-google btn-sm " type="submit">删除文件</button>
                                <button onclick="$('#users-content').empty();" type="button"
                                        class="btn btn-facebook btn-sm " data-toggle="modal" data-target="#myModal">
                                    新建文件夹
                                </button>
                                <button onclick="$('#users-content').empty();" type="button"
                                        class="btn btn-github btn-sm " data-toggle="modal" data-target="#myModa2">
                                    上传文件
                                </button>
                                @if(isset($parent))
                                    <a href="@if($parent>0){{'/files/'.$parent}}@else /files @endif" class="btn btn-google btn-sm ">返回上一级目录</a>
                            @endif
                            <!-- 模态框（Modal） -->

                                <ul class="pagination pagination-sm no-margin pull-right">
                                    {{ $files->links() }}
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="users-content">

            </div>

            <div class="modal fade" id="myModa2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/files/update/file/@if(isset($id)){{$id}}@else{{0}}@endif" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">上传文件</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="btn btn-default btn-file">
                                        <i class="fa fa-paperclip"></i> 选择文件
                                        <input type="file" name="file">
                                    </div>
                                    <p class="help-block">Max. 10Mb</p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                </button>
                                <button type="submit" class="btn btn-primary">上传</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form action="/files/new/folder/@if(isset($id)){{$id}}@else{{0}}@endif" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">新建文件夹</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control" placeholder="文件夹名" name="name">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                </button>
                                <button type="submit" class="btn btn-primary">创建</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </section>



@endsection
