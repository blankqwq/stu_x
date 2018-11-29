@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            用户信息表
            <small>控制面板</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">仪表盘</li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="box">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive thumbnail" src="{{ $oneuser->avatar }}"
                         width="300px" height="300px">

                    <h3 class="profile-username text-center">姓名：{{ $oneuser->name }}</h3>

                    <p class="text-muted text-center">个性签名：{{ $oneuser->sign }}</p>

                    <p class="text-muted text-center">性别：{{ $oneuser->sex }}</p>

                    <p class="text-muted text-center">邮箱地址：{{ $oneuser->email }}</p>
                    <hr>

                    {{-- 用户发布的内容 --}}
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="{{ active_class(if_query('tab', null)) }}">
                                    <a href="{{ route('users.show', $oneuser->id) }}">Ta 的班级</a>
                                </li>
                                <li class="{{ active_class(if_query('tab', 'classe')) }}">
                                    <a href="{{ route('users.show', [$oneuser->id, 'tab' => 'classe']) }}">Ta 加入的班级</a>
                                </li>
                            </ul>
                            @if (if_query('tab', 'classe'))
                                @include('stu.user._class', ['classes' => $oneuser->classes()->recent()->paginate(5)])
                            @else
                                @include('stu.user._class', ['classes' => $oneuser->classe()->recent()->paginate(5)])
                            @endif
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::id() === $oneuser->id)
                        <button class="btn btn-primary btn-block" onclick="window.location.href='{{route('users.edit',$oneuser)}}'">修改资料</button>
                    @endif

                </div>


            </div>
        </div>
    </section>
@stop