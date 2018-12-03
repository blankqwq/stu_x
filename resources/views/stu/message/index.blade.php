@extends('layouts.admin')
@section('bar','skin-blue sidebar-mini sidebar-collapse')
@section('content')
    <section class="content-header">
        <h1>
            消息系统
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">消息系统首页</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">


                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">消息栏</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                        @role(config('code.role'))
                            <li class="{{ active_class(if_query('tab',null)) }}">
                                <a href="{{ route('messages.index') }}">
                                    <i class="fa fa-inbox"></i>创建通知
                                    <span class="label label-warning pull-right">{{$count_notice}}</span></a>
                            </li>
                        @endrole
                            <li class="{{ active_class(if_query('tab', 'request')) }}">
                                <a href="{{ route('messages.index', [ 'tab' => 'request']) }}">
                                    <i  class="fa fa-file-text-o"></i> 请求消息
                                    <span class="label label-danger pull-right">{{$count_request}}</span></a>
                            </li>

                            <li class="{{ active_class(if_query('tab', 'reply')) }}">
                                <a href="{{ route('messages.index', [ 'tab' => 'reply']) }}">
                                    <i class="fa fa-envelope-o"></i> 文章回复
                                    <span class="label label-danger pull-right">{{$count_reply}}</span></a>
                                </a>
                            </li>
                            <li class="{{ active_class(if_query('tab', 'pm')) }}">
                                <a href="{{ route('messages.index', [ 'tab' => 'pm']) }}">
                                    <i class="fa fa-envelope-o"></i> 系统消息与私信
                                    <span class="label label-danger pull-right">{{$count_pm}}</span></a>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">消息发送</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ active_class(if_query('tab', 'send')) }}">
                                <a href="{{ route('messages.index', ['tab' => 'send']) }}">
                                    <i class="fa fa-circle-o text-red"></i> 发送私信
                           </a></li>
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

        @if(if_query('tab', 'pm'))
            @include('stu.message._data',['notifications' => $user->notifications()->where('type',
            \App\Notifications\PersonMessage::class)->paginate(5)])
        @elseif(if_query('tab', 'request'))
            @include('stu.message._request', ['notifications' => $user->notifications()->where('type',
            \App\Notifications\NewStuJinClass::class)->paginate(5)])
        @elseif(if_query('tab', 'reply'))
            @include('stu.message._reply', ['notifications' => $user->notifications()->where('type',
            \App\Notifications\TopicReplied::class)->paginate(5)])
        @elseif(if_query('tab', 'send'))
            @include('stu.message._send',['datas'=>\Illuminate\Support\Facades\Auth::user()->classes()->with('student', 'creator')->get()])
        @else
            @include('stu.message._notice', ['notifications' => $user->notifications()->where('type',
            \App\Notifications\ClassCreate::class)->paginate(5)])
        @endif
            <!-- /.col -->
            <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection