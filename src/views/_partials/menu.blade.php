<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
            @foreach ($menu as $item)
                @if ($item->isSeparator() == true)
                    <li><a href="javascript: void(0);">&nbsp;</a></li>
                @else
                    {!! $item->render() !!}
                @endif
            @endforeach
		</ul>
	</div>
</div>