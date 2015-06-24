@if($displayType == 'FULL')
    <div class="col-lg-12">
@elseif($displayType == 'HALF')
    <div class="col-lg-6">
@else
    <div class="col-lg-12">
@endif

    <div class="panel panel-inverse">
        <div class="panel-heading">
            {!! $group->getDescription() !!}
        </div>
        <div class="panel-body">
            @foreach($items as $item)
                {!! $item->render() !!}
            @endforeach
        </div>
    </div>
</div>