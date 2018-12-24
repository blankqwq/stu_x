<div class="col-md-9" >
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">作业图文分析</h3>

        <div class="box-tools pull-right">
            <div class="has-feedback">
                <input type="text" class="form-control input-sm" placeholder="Search ">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
        </div>
    </div>
    <div class="box-body no-padding">
        <hr>

        <div class="table-responsive mailbox-messages">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">作业提交情况图</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div>
            </div>
        </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">作业分数对比</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div>
            </div>
    <div class="box-footer no-padding">

    </div>
</div>
</div>
</div>
<script src="{{asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
<script>
    <?php
        $count_s=0;
        foreach ($homeworks as $homework){
            $count_s+=$homework->posters_count;
        }
    ?>
    var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    colors: ["#3c8dbc", "#f56954"],
    data: [
    {label: "提交率", value: {{($ls=$count_s/($homeworks->count()*($classe->numbers-1)))*100}}},
    {label: "未提交率", value: {{(1-$ls)*100}}},
    ],
    hideHover: 'auto'
    });
    @if(!empty($homeworks))
        var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [
            @foreach($homeworks as $homework)
             {y: '{{$homework->created_at->toDateTimeString()}}', a:{{$homework->getFraction($homework->id) }}, b:60},
            @endforeach
        ],
        barColors: ['#00a65a', '#f56954'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['平均分', '及格线'],
        hideHover: 'auto'
        });
    @endif
</script>