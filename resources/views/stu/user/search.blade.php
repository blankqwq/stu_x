@extends('layouts.admin')
@section('users','active')
@section('content')
    <section class="content-header">
        <h1>
            用户搜索
            <small>面板</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">用户搜索</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="box">

                <form action="/users/search" method="post">
                    <div class="input-group input-group-lg" >
                        {{ csrf_field() }}
                        <input type="text" name="search" class="form-control pull-right"
                               placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection