@extends('layouts.admin')
@section('content')

    <section class="content-header">
        <h1>
            班级列表
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
                            $("html,body").animate({scrollTop:0},800);
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
                        <h3 class="box-title">班级列表</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                {{ csrf_field() }}
                                <input type="text" name="search" class="form-control pull-right"
                                       placeholder="Search">

                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <form action="/users/del" method="post">
                            @include('particles.error')
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>班级名</th>
                                    <th>类型</th>
                                    <th>加入时间</th>
                                    <th>班级人数</th>
                                    <th>班级bossemail</th>
                                    <th>操作</th>
                                </tr>
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                @foreach($classes as $classe)
                                    <tr>
                                        <td>@if(\Illuminate\Support\Facades\Auth::id()!==$classe->id)
                                                <input type="checkbox" value="{{ $classe->id }}" name="ids[]">
                                            @endif</td>
                                        <td>{{ $classe->name }}</td>
                                        <td>
                                            {{ $classe->type->category }}
                                        <td>{{ $classe->created_at }}</td>
                                        <td>{{ $classe->numbers }}</td>
                                        <td>{{$classe->creator->email }}</td>
                                        <td><a href="{{route('classes.small',$classe->id)}}" id="read"><span
                                                        class="label label-warning">查看</span></a>
                                            @if($classe->user_allow==null ||$classe->user_allow==0 )

                                                <a href="#"><span
                                                            class="label label-danger">未通过审核</span>
                                                </a>
                                            @else
                                                <a href="{{ route('classes.users',$classe->id) }}"><span
                                                            class="label label-success">成员查看</span>
                                                </a>
                                                <a href="{{ route('classes.show',$classe->id) }}"><span
                                                            class="label label-danger">{{$classe->type->category}}主页</span>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if(!$classes)
                                    暂无班级
                                @endif
                            </table>
                            <div class="box-footer">
                                {{--<button class="btn btn-google btn-sm ">删除</button>--}}
                                <ul class="pagination pagination-sm no-margin pull-right">
                                {{ $classes->links() }}
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="class-content">

            </div>
        </div>

    </section>

@stop