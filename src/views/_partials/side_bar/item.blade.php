<li>
    <a @if (!empty($subItems)) class="has-sub" href="javascript:;" @else href="{{$link}}" @endif>
        <span></span>
        @if (!empty($icon))<i class="fa {{$icon}}"></i>@endif
        <span>{{$title}}</span>
        @if (!empty($subItems))
            <ul class="sub-menu">
            @foreach ($subItems as $item)
                {!! $item->render() !!}
            @endforeach
            </ul>
        @endif
    </a>
</li>