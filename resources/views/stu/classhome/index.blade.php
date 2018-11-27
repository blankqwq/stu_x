@extends('layouts.admin')
@section('bar','skin-blue sidebar-mini sidebar-collapse')
@section('content')
    <section class="content-header">
        <h1>
            {{$classe->name}}主页
            <small>{{ $classe->numbers }}人</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$classe->name}}首页</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">


                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">功能栏</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">

                            <img src="{{ $classe->avatar }}" id="avatarImg"
                                 class="profile-user-img img-responsive img-circle"/>
                            <p class="text-center">{{ $classe->name }}</p>
                            <li class="{{ active_class(if_query('tab',null)) }}">
                                <a href="{{ route('classes.show', [$classe->id]) }}">
                                    <i class="fa fa-inbox"></i>{{$classe->type->category}}公告
                                    <span class="label label-warning pull-right">{{$count_notice}}</span></a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'need')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'need']) }}">
                                    <i  class="fa fa-file-text-o"></i> {{$classe->type->category}}需求
                                    <span class="label label-danger pull-right">{{$count_need}}</span></a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'file')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'file']) }}">
                                    <i class="fa fa-envelope-o" /></i> {{$classe->type->category}}文件
                                </a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'live')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'live']) }}">
                                    <i class="fa fa-envelope-o"></i> {{$classe->type->category}}图文直播</a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'chart')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'chart']) }}">
                                    <i class="fa fa-envelope-o"></i>  聊天室</a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'send')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'send']) }}">
                                    <i class="fa fa-filter"></i> 发送</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">作业功能</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ active_class(if_query('tab', 'homework')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'homework']) }}"><i
                                            class="fa fa-circle-o text-red"></i> 查看作业<span
                                            class="label label-warning pull-right">{{$count_homework}}</span></a></li>
                            <li class="{{ active_class(if_query('tab', 'fraction')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'fraction']) }}">
                                    <i class="fa fa-circle-o text-yellow"></i> 作业分数</a></li>
                            <li class="{{ active_class(if_query('tab', 'sendwork')) }}">
                                <a href="{{ route('classes.show', [$classe->id, 'tab' => 'sendwork']) }}"><i
                                            class="fa fa-circle-o text-light-blue"></i> 发布作业</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

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

        @if(if_query('tab', 'need'))
            @include('stu.classhome._data', ['datas' => $classe->needs()->with('replies')->recent()->paginate(10)])
        @elseif(if_query('tab', 'file'))
            @include('stu.classhome._file', ['files' => ''])
        @elseif(if_query('tab', 'live'))
            @include('stu.classhome._live', ['lives' =>''])
        @elseif(if_query('tab', 'chart'))
            @include('stu.classhome._chart',['charts'=>''])
        @elseif(if_query('tab', 'send'))
            @include('stu.classhome.write',['types'=>$types])
        @elseif(if_query('tab', 'sendwork'))
            @include('stu.classhome.sendwork')
        @elseif(if_query('tab', 'fraction'))
            @include('stu.classhome._fraction',['homeworks'=>$classe->homeworks()->with('publisher','posters')->withCount('posters')->recent()->paginate(10)])
        @elseif(if_query('tab', 'homework'))
            @include('stu.classhome._homework',['homeworks'=>$classe->homeworks()->with('publisher')->withCount('posters')->recent()->paginate(10)])
        @else
            @include('stu.classhome._data',['datas' => $classe->notices()->with('replies')->recent()->paginate(10)])
        @endif
            <!-- /.col -->
            <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection