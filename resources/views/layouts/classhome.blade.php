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
                                <a href="/classhome/{{$classe->id}}/index.html">
                                    <i class="fa fa-inbox"></i>{{$classe->type->category}}公告
                                    <span class="label label-warning pull-right">{{$gongaocount}}</span></a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'need')) }}">
                                <a href="/classhome/{{$classe->id}}/request.html">
                                    <i  class="fa fa-file-text-o"></i> {{$classe->type->category}}需求
                                    <span class="label label-danger pull-right">{{$xuqiucount}}</span></a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'file')) }}">
                                <a href="/classhome/{{$classe->id}}/file.html">
                                    <i class="fa fa-envelope-o"></i> {{$classe->type->category}}文件</a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'live')) }}">
                                <a href="/classhome/{{$classe->id}}/file.html">
                                    <i class="fa fa-envelope-o"></i> {{$classe->type->category}}图文直播</a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'chart')) }}">
                                <a href="/classhome/{{$classe->id}}/write.html">
                                    <i class="fa fa-envelope-o"></i>  聊天室</a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'send')) }}">
                                <a href="/classhome/{{$classe->id}}/write.html">
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
                            <li><a href="/classhome/{{$classe->id}}/homework/index.html"><i
                                            class="fa fa-circle-o text-red"></i> 查看作业<span
                                            class="label label-warning pull-right">{{$homecount}}</span></a></li>
                            <li><a href="/classhome/{{$classe->id}}/homework/me.html"><i
                                            class="fa fa-circle-o text-yellow"></i> 作业分数</a></li>
                            <li><a href="/classhome/{{$classe->id}}/homework/create.html"><i
                                            class="fa fa-circle-o text-light-blue"></i> 发布作业</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        @yield('home-content')
        <!-- /.col -->
            <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection