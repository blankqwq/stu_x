@forelse ($stuhomeworks as $stuhomework)
    <div class="mailbox-read-message">
        <div class="item">
            <div class=" media"  name="stuhomework{{ $stuhomework->id }}" id="stuhomework{{ $stuhomework->id }}">
                <div class="avatar pull-left">
                    <a href="{{ route('users.show', [$stuhomework->poster->user_id]) }}">
                        <img class="media-object img-thumbnail" alt="{{ $stuhomework->poster->name }}" src="{{ $stuhomework->poster->avatar }}"  style="width:48px;height:48px;"/>
                    </a>
                </div>

                <div class="infos">
                    <div class="media-heading">
                        <a href="{{ route('users.show', [$stuhomework->poster->user_id]) }}" title="{{ $stuhomework->poster->name }}">
                            {{ $stuhomework->poster->name }}
                        </a>
                        <span> •  </span>
                        <span class="meta" title="{{ $stuhomework->created_at }}">{{ $stuhomework->created_at->diffForHumans() }}</span>

                        {{-- 回复删除按钮 --}}
                        <span class="meta pull-right">
                            <a title="作业分数">
                            @if($stuhomework->fraction)
                                {{$stuhomework->fraction}}
                            @else
                                暂未批改
                            @endif
                            </a>
                        </span>
                    </div>
                    <div class="reply-content">
                        {!! $stuhomework->content !!}
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@empty
    <div class="mailbox-read-message">
        <div class="item">
            <div class=" media"  name="reply" id="reply">
                <div class="avatar pull-left">
                    <a href="">
                        <img class="media-object img-thumbnail" alt="系统" src="/storage/uploads/images/default.jpg"  style="width:48px;height:48px;"/>
                    </a>
                </div>

                <div class="infos">
                    <div class="media-heading">
                        <a href="" title="系统：">
                            系统：
                        </a>
                        <span> •  </span>
                        <span class="meta" title="时间">00:00</span>

                    </div>
                    <div class="reply-content">
                        暂时没有人提交，你快抢占先机
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endforelse
