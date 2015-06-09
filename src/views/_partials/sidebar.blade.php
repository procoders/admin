<div id="sidebar" class="sidebar">
    {{-- begin sidebar user --}}
    @include('admin::_partials.side_bar.user')
    {{-- end sidebar user --}}
    {{-- begin sidebar nav --}}
    <ul class="nav">
        @foreach ($menu as $item)
            @if ($item->isSeparator() == true)
                <li style="height: 1px; border-top: 1px solid #1a2229;">&nbsp;</li>
            @else
                {!! $item->render() !!}
            @endif
        @endforeach
    </ul>
    {{-- end sidebar nav --}}
</div>
<div class="sidebar-bg"></div>