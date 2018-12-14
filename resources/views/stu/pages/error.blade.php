
@extends('layouts.admin')
@section('error','active')

@section('content')
    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">错误</div>
            <div class="panel-body text-center">
                <h1>{{ $message }}</h1>
                @if(isset($redirect))
                <a class="btn btn-warning" href="{{$redirect}}">点击处理</a>
                @endif
                <a class="btn btn-primary" href="{{route('stu.home')}}">返回首页</a>
            </div>
        </div>
    </section>
@endsection