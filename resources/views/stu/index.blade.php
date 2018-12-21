@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/morris.js/morris.css')}}">
@endsection
@section('content')


    <section class="content-header">
        <h1>
            仪表盘
            <small>控制面板</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> HOME</a></li>
            <li class="active">仪表盘</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            @if($classe)
                                {{$classe->name}}
                            @else
                                0
                            @endif</h3>

                        <p>最近加入的班级</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('classes.join')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>@if($stuhomework)
                                {{$stuhomework->fraction}}
                            @else
                                0
                            @endif<sup style="font-size: 20px">%</sup></h3>

                        <p>分数</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$file}}</h3>

                        <p>文件数量</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('files.index')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$messages}}</h3>

                        <p>消息数量</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('messages.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="col-md-5">
            <!-- AREA CHART -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">最近分数</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        @include('stu.homework.recently',['homeworks'=>$homework_get])


    </section>
@endsection

@section('js')
    <script src="{{asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
    <script>
        $(function () {
            var area = new Morris.Line({
                element: 'revenue-chart',
                resize: true,
                data: [
                    @foreach($stuhomeworks as $s)
                    {y: '{{$s->homework->created_at->toDateTimeString()}}', item1: {{$s->fraction }}, item2:{{$homework->getFraction($s->homework_id)  }}},
                    @endforeach
                ],
                xkey: 'y',
                ykeys: ['item1','item2'],
                labels: ['我的分数', '平均分','标题'],
                lineColors: ['#3c8dbc','#a0d0e0'],
                hideHover: 'auto'
            });


        });
    </script>
@endsection