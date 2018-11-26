<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">查看详细</h3>

        <div class="box-tools pull-right">
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                        class="fa fa-chevron-left"></i></a>
            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                        class="fa fa-chevron-right"></i></a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3>{{$topic->title}}</h3>
            <h5>{{$topic->sender->email}}
                <span class="mailbox-read-time pull-right">{{\Carbon\Carbon::parse($topic->created_at)->diffForHumans()}}</span>
            </h5>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body"
                        title="Delete">
                    <i class="fa fa-trash-o"></i></button>
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print" onclick="window.location.href=''">
                <i class="fa fa-edit"></i></button>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            {!! $topic->content !!}
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <ul class="mailbox-attachments clearfix">
            @if($topic->att_name)
                <li>
                    <span class="mailbox-attachment-icon"><i class="fa fa-file"></i></span>

                    <div class="mailbox-attachment-info">
                        <a href="#" class="mailbox-attachment-name"><i class="fa fa-file"></i> {{ $topic->att_name }}</a>
                        <span class="mailbox-attachment-size">
                            附件下载<a href="{{ $topic->att_url}}" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                    </div>
                </li>
            @endif


        </ul>
    </div>
    @forelse ($topic->replies as $reply)
        <div class="item">
            <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">

            <p class="message">
                <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                    Susan Doe
                </a>
                I would like to meet you to discuss the latest news about
                the arrival of the new theme. They say it is going to be one the
                best themes on the market
            </p>
        </div>
    @empty
        <div class="mailbox-read-message">
            <div class="item">
                <img src="" alt="user image" class="offline">

                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                        Susan Doe
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                </p>
            </div>
        </div>
    @endforelse
    {{--@if($topic->)--}}
    {{--@endif--}}
</div>
