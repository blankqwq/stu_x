@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
            班级审核
            <small>审核所有班级</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">users/me</li>
        </ol>
    </section>
    <script>
        $(document).ready(function () {
            $('[id=func]').click(function () {
                htmlobj = $.ajax(
                    {

                        type: "POST",
                        url: this.href,
                        data:"_token={{ csrf_token() }}",
                        success: function () {
                            if (htmlobj.responseText=='1'){
                                alert('操作成功')
                                location.reload()
                            }

                        },
                        error: function () {
                            alert('操作失败')
                        }

                    });
                return false;
            });
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

    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">全部班级</h3>
                        <div class="box-tools">
                            <form action="/classes/search" method="post">
                                <div class="input-group input-group-sm" style="width: 150px;">

                                    {{ csrf_field() }}
                                    <input type="text" name="name" class="form-control pull-right"
                                           placeholder="班级名">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <form action="/users/del" method="post">
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>班级名</th>
                                    <th>类型</th>
                                    <th>创建时间</th>
                                    <th>班级人数</th>
                                    <th>班级bossemail</th>
                                    <th>审核</th>
                                    <th>操作</th>
                                </tr>
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                @foreach($classes as $classe)
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $classe->id }}" name="ids[]">
                                        </td>
                                        <td>{{ $classe->name }}</td>
                                        <td>{{ $classe->type->category }}</td>
                                        <td>{{ $classe->created_at }}</td>
                                        <td>{{ $classe->numbers }}</td>
                                        <td>{{$classe->creator->email }}</td>
                                        <td>
                                            @if ($classe->user_allow != 0)
                                                <span class="label label-success">审核成功</span>
                                            @elseif($classe->user_allow === 0)
                                                <span class="label label-danger">未通过</span>
                                            @else ($classe->user_allow === null)
                                              <span class="label label-warning">待审核</span>
                                            @endif
                                        </td>
                                        <td><a href="{{route('classes.small',$classe)}}" id="read"><span
                                                        class="label label-warning">查看</span></a>
                                            @role(config('code.role'))
                                            <a href="{{route('agree.classes',$classe)}}" id="func"><span
                                                        class="label label-success">通过</span></a>
                                            <a href="{{route('disagree.classes',$classe)}}" id="func"><span
                                                        class="label label-danger">不通过</span></a>
                                            @endrole

                                        </td>
                                    </tr>
                                @endforeach
                                @if(!$classes)
                                    未加入任何班级
                                @endif

                            </table>

                            <div class="box-footer">
                                <button class="btn btn-google btn-sm ">删除</button>
                                {{ $classes->links() }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="class-content">

            </div>
        </div>


    </section>


@endsection
