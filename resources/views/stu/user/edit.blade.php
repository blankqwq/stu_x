@extends('layouts.admin')

@section('title','编辑资料')

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
        <div class="box">
            @include('layouts.error')
            <div class="box-body">

                    <div class="panel-body">

                        <form action="{{ route('users.update', $user) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('put')}}
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label for="" class="avatar-label">用户头像</label>
                                <input type="file" name="avatar">

                                @if($user->avatar)
                                    <br>
                                    <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" />
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name-field">用户名</label>
                                <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" />
                            </div>
                            <div class="form-group">
                                <label for="email-field">邮 箱</label>
                                <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" />
                            </div>
                            <div class="form-group">
                                <label for="sign-field">个人简介</label>
                                <textarea name="sign" id="sign-field" class="form-control" rows="3">{{ old('sign', $user->sign) }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </section>
@endsection