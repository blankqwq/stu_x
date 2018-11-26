@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            消息盒子
            <small>13 new messages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="compose.html" class="btn btn-primary btn-block margin-bottom">发消息</a>

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
                            <li class="active"><a href="#"><i class="fa fa-inbox"></i> 收件箱
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> 发件箱</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i> 草稿箱</a></li>
                            <li><a href="#"><i class="fa fa-filter"></i> 已读箱<span
                                            class="label label-warning pull-right">65</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> 回收站</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @yield('mail-content')
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection