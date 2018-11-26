@extends('layouts.admin')

@section('title', $user->name . ' 的个人中心')
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
                    <img class="profile-user-img img-responsive thumbnail" src="{{ $user->avatar }}"
                         width="300px" height="300px">

                    <h3 class="profile-username text-center">姓名：{{ $user->name }}</h3>

                    <p class="text-muted text-center">个性签名：{{ $user->sign }}</p>

                    <p class="text-muted text-center">性别：{{ $user->sex }}</p>

                    <p class="text-muted text-center">邮箱地址：{{ $user->email }}</p>
                    <hr>

                    {{-- 用户发布的内容 --}}
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                                <li class="{{ active_class(if_query('tab', null)) }}">
                                    <a href="{{ route('users.show', $user->id) }}">Ta 的班级</a>
                                </li>
                                <li class="{{ active_class(if_query('tab', 'classe')) }}">
                                    <a href="{{ route('users.show', [$user->id, 'tab' => 'classe']) }}">Ta 加入的班级</a>
                                </li>
                            </ul>
                            @if (if_query('tab', 'classe'))
                                @include('stu.user._class', ['classes' => $user->classes()->recent()->paginate(5)])
                            @else
                                @include('stu.user._class', ['classes' => $user->classe()->recent()->paginate(5)])
                            @endif
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::id() === $user->id)
                        <button class="btn btn-primary btn-block" onclick="window.location.href='{{route('users.edit',$user)}}'">修改资料</button>
                    @endif

                </div>


            </div>
        </div>
    </section>
@stop