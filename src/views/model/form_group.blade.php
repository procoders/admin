@if($displayType == 'FULL')
    <div class="col-lg-12">
@elseif($displayType == 'HALF')
    <div class="col-lg-6">
@else
    <div class="col-lg-12">
@endif

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">{!! $group->getDescription() !!}</h4>
        </div>
        <div class="panel-body">
            @foreach($items as $item)
                {!! $item->render() !!}
            @endforeach
        </div>
    </div>
</div>