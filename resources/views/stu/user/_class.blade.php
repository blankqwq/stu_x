@if (count($classes))

    <ul class="list-group">
        @foreach ($classes as $classe)
            <li class="list-group-item">
                {{--{{ route('classes.show', $topic->id) }}--}}
                <a href="{{route('classes.show',$classe->id)}}">
                    {{ $classe->name }}
                </a>
                <span class="meta pull-right">
                {{ $classe->type->category }}
                <span> ⋅ </span>
                    {{ $classe->created_at->diffForHumans() }}
            </span>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
{!! $classes->render() !!}