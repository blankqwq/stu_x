@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            加入
            <small>加入------{{ $classe->name }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">加入团体</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="box">

                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $classe->avatar }}"
                         alt="未找到图片">
                    <h3 class="profile-username text-center">name:{{ $classe->name }}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>创建时间：</b> <a class="pull-right">{{ $classe->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>创建者</b> <a class="pull-right"
                                          href="">{{ $classe->creator->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>类型</b>
                                <a class="pull-right"> {{$classe->type->category}}</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <form action="{{route('classuser.store',$classe)}}" method="post">
                    {{ csrf_field() }}
                    @if($classe->verification==0)


                        <div class="box-body">

                            <div class="form-group">
                                <label>申请</label>
                                <input type="text" class="form-control" name="content" placeholder="申请内容">
                            </div>
                            @if($classe->password)
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="text" class="form-control" name="password" placeholder="输入班级加入密码">
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary btn-block btn-flat">提交审核</button>
                            <div class="form-group">
                                <p>您发送的申请内容将会通过邮件发送至老师邮箱</p>
                            </div>
                        </div>



                    @else
                        <div class="box-body">
                            <div class="form-group">
                                <label>申请消息</label>
                                <textarea type="text" class="form-control" name="content" >老师你好，我是{{$user->name}}!</textarea>
                            </div>
                            @if($classe->password)
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="text" class="form-control" name="password" placeholder="输入班级加入密码">
                                </div>
                            @endif
                            @if($classe->verification)
                                <div class="form-group">
                                    <p>密码输入正确后，将等待老师的审核</p>
                                </div>
                            @else
                                <div class="form-group">
                                    <p>密码输入正确后，将自动加入</p>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary btn-block btn-flat">申请</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </section>
@endsection