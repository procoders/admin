@extends('admin::_layout.inner')

@section('innerContent')
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				{{{ $title }}}
				@if(isset($subtitle)) <small>{{ $subtitle }}</small> @endif
                <a class="btn btn-success m-r-5 pull-right" {{ $modelItem->isCreatable() ? '' : 'disabled' }} href="{{{ $newEntryRoute }}}">
                    <i class="fa fa-plus"></i>
                    {{{ Lang::get('admin::lang.table.new-entry') }}}
                </a>
			</h1>
            {{-- TODO: change this --}}
			@if(Session::has('message'))
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Session::get('message') }}
				</div>
			@endif
		</div>
	</div>
    <?php $tableId = uniqid(); ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse">
                <div class="panel-heading">{{{ $title }}}</div>
                    <div class="panel-body">
                        @if($modelItem->hasCustomFilters())
                            @include('admin::model.filters')
                        @endif
                        <div class="table-responsive">
                            <table id="{{$tableId}}" class="table table-striped table-bordered adm-table">
                                <thead>
                                    <tr>
                                        @foreach ($columns as $column)
                                        <th>{{ ucfirst($column->getLabel()) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $i => $row)
                                        <tr class="@if ($i%2) odd @else even @endif">
                                            @foreach ($columns as $column)
                                                {!! $column->render($row, count($rows)) !!}
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                                @if ($modelItem->isColumnFilter() && ! $modelItem->isAsync())
                                    <tfoot>
                                        <tr>
                                            @foreach ($columns as $column)
                                                <td></td>
                                            @endforeach
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
			</div>
		</div>
	</div>
    <?php
        AssetManager::addStyle('admin::css/data-table.css');
        AssetManager::addScript('admin::js/jquery.dataTables.js');
        AssetManager::addScript('admin::js/dataTables.colReorder.js');
        AssetManager::addScript('admin::js/dataTables.keyTable.js');
        AssetManager::addScript('admin::js/dataTables.fixedHeader.js');
        AssetManager::addScript('admin::js/dataTables.colVis.js');
        AssetManager::addScript('admin::js/table-manager.js');
    ?>
    <script>
        <?php
        AssetManager::addScript('admin::js/bootstrap-datepicker.js');
        AssetManager::addStyle('admin::css/datepicker.css');
        AssetManager::addStyle('admin::css/model-filters.css');
        ?>

        <?php
            $sortings = [];
            foreach ($columns as $i => $column) {
                if ($column->isSortable() == false)
                    $sortings[] = [
                        'bSortable' => false,
                        'aTargets' => [$i],
                    ];
            }

            $filters = [];

            foreach ($modelItem->getCustomFilters() as $key => $filter) {
                $filterData = [
                    'type' => $filter->getType(),
                    'sequanceNumber' => (int)$filter->getColumnSequenceNumber()
                ];
                if ($filterData['type'] == 'text') {
                    if ($filter->getName() == 'price') {
                        $filterData['type'] = 'price';
                    }
                } elseif ($filterData['type'] == 'date') {
                    $filterData['rule'] = $filter->getRule();
                }
                $filters[] = $filterData;
            }
        ?>

        var filters = {!! json_encode($filters) !!};
        $(document).ready(function() {
            var table = AdminTable.init('{{$tableId}}', {
                exclColumns: {{count($columns)-1}},
                sortConfig: [{!! json_encode($sortings) !!}],
                filters: filters
            });
        });
    </script>
@stop