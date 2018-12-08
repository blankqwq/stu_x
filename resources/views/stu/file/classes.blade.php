@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            用户管理
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">users/me</li>
        </ol>
    </section>
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
                            $('#class-content').empty();
                            $("#class-content").html(htmlobj.responseText);
                        },
                        error: function () {
                            alert('获取失败联系管理员')
                        }

                    });
                return false;
            });
        });
    </script>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">全部班级</h3>
                    </div>
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>班级名</th>
                            <th>类型</th>
                            <th>创建时间</th>
                            <th>班级人数</th>
                            <th>班级bossemail</th>
                            <th>操作</th>
                        </tr>
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        @foreach($classes as $classe)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $classe->id }}" name="ids[]">
                                </td>
                                <td>{{ $classe->name }}</td>
                                <td>
                                        {{ $classe->type->category }}
                                <td>{{ $classe->created_at }}</td>
                                <td>{{ $classe->numbers }}</td>
                                <td>{{$classe->creator->email }}</td>
                                <td><a href="{{route('classes.show',[$classe->id,'tab'=>'file'])}}"><span
                                                class="label label-warning">文件</span></a>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @if(!$classes)
                            没有班级
                        @endif

                    </table>

                    <div class="box-footer">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            {{$classes->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" id="class-content">

        </div>



    </section>


@endsection
