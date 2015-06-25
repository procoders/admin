@extends('admin::_layout.inner')

@section('innerContent')
    <script>
        $('form[name=batchDelete]').on('submit', function(e){
            e.preventDefault();
        });
        function processBatchDelete(model) {
            var confirmed = confirm('Are you really want to delete checked items?');
            if (confirmed === true) {
                var ids = [];
                $('input[type=checkbox][name='+model+']').each(function(){
                    if ($(this).is(':checked')) {
                        ids.push($(this).val());
                    }
                });
                $('input[name=ids]').val(ids);
                $('form[name=batchDelete]').submit();
            }
        }
        function setAll(model) {
            if ($('input[name=deleteAll]').is(':checked')) {
                $('input[type=checkbox][name='+model+']').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('input[type=checkbox][name='+model+']').each(function() {
                    $(this).prop('checked', false);
                });
            }
        }
    </script>
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
    <?php
        $tableId = uniqid();
    ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse">
                <div class="panel-heading">{{{ $title }}}</div>
                    <div class="panel-body">
                        @if (!empty($viewFilters))
                            @include('admin::model.filters')
                        @endif

                        <div class="table-responsive">
                            <table id="{{$tableId}}" class="table table-striped table-bordered adm-table">
                                <thead>
                                    <tr>
                                        @foreach ($columns as $column)
                                            @if ($column->isBatchAction())
                                                <th style="width: 100px; text-align: right;">
                                                    <form name="batchDelete" action="/admin/{{$modelItem->getAlias()}}/batch/delete" method="post">
                                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                        <input type="hidden" name="ids" value="">
                                                        <a href="javascript:;" onclick="processBatchDelete('{{ $modelItem->getModelTable() }}')" style="float: left;">
                                                            <i class="fa fa-times" style="color: #ec3131; font-size: 16px;"></i>
                                                        </a>
                                                        <input type="checkbox" name="deleteAll" onchange="setAll('{{ $modelItem->getModelTable() }}');" />
                                                    </form>
                                                </th>
                                            @else
                                                <th>{{ ucfirst($column->getLabel()) }}</th>
                                            @endif
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
        AssetManager::addScript('admin::js/editable.js');
        AssetManager::addStyle('admin::css/bootstrap-editable.css');
        AssetManager::addStyle('admin::css/editable.css');
        ?>

        var filters = {!! json_encode($jsFilters) !!};

        $(document).ready(function() {
            var table = AdminTable.init('{{$tableId}}', {
                exclColumns: {{count($columns)-1}},
                sortConfig: [{!! json_encode($unsortableColumns) !!}],
                filters: filters
            });
        });

    </script>
@stop
