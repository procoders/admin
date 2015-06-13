<?php
AssetManager::addScript('admin::js/bootstrap-datepicker.js');
AssetManager::addStyle('admin::css/datepicker.css');
?>
<div class="row">
    <div class="col-lg-12">
        <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
            <div class="filter-wrapper">
                @foreach ($viewFilters as $filterIndex => $filter)
                    {!! $filter->render($tableId, $filterIndex) !!}
                @endforeach
            </div>
            <a href="#" id="reset-{{$tableId}}" class="reset">Reset form</a>
        </form>
    </div>
</div>