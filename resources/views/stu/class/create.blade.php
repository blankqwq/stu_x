@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            创建班级
            <small>创建一个小团体咯</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">创建班级</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="box">
                <form action="{{route('classes.store')}}" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('particles.error')
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <label>班级图片</label>
                                <input type="file" name="avatar" id="pic" class="center-block"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>班级名</label>
                            <input type="text" class="form-control" name="name" placeholder="班级名称">
                        </div>
                        <div class="form-group">
                            <label>加入密码</label>
                            <input type="text" class="form-control" name="password" placeholder="需要则写入，不需要就不用写">
                        </div>
                        <div class="form-group">
                            <label>是否需要认证：</label>
                            <label class="radio-inline">
                                <input type="radio" name="verification"  id="inlineRadio1" value="1"> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="verification"  id="inlineRadio2"  value="0"> 否
                            </label>
                        </div>
                        <div class="form-group">
                            <label>选择班级类型</label>
                            <select class="form-control" name="type_id">
                                <option>请选择班级</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->category }}</option>
                                @endforeach

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-flat">提交审核</button>

                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection