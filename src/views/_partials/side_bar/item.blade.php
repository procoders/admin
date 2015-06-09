@if (!empty($subItems))
<li class="has-sub expand @if( in_array(\Request::url(), $item->getSubUrls())) active @endif " >
    <a href="javascript:;">
        <b class="caret pull-right"></b>
        @if (!empty($icon))<i class="fa {{$icon}}"></i>@endif
        <span>{{$title}}</span></span>
    </a>
    <ul class="sub-menu">
        @foreach ($subItems as $item)
            {!! $item->render() !!}
        @endforeach
    </ul>
</li>
@else
<li @if(\Request::url() === $link) class="active" @endif>
    <a href="{{$link}}">
        @if (!empty($icon))<i class="fa {{$icon}}"></i>@endif
        <span>{{$title}}</span>
    </a>
</li>
@endif