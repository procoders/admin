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
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-inverse">
                <div class="panel-heading">{{{ $title }}}</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <?php $tableId = uniqid(); ?>
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
    <style>
        .adm-table td.focus {
            -webkit-box-shadow: inset 1px 0px 11px 0px rgba(22, 123, 169, 0.64);
            -moz-box-shadow:    inset 1px 0px 11px 0px rgba(22, 123, 169, 0.64);
            box-shadow:         inset 1px 0px 11px 0px rgba(22, 123, 169, 0.64);
            border: none;
            outline: none !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            AdminTable.init('{{$tableId}}', {
                exclColumns: {{count($columns)-1}},
                sortConfig: [
                @foreach ($columns as $i => $column)
                    @if ($column->isSortable() == false)
                    { 'bSortable': false, 'aTargets': [ {{$i}} ]},
                    @endif
                @endforeach
                ]
            });
        });
    </script>
@stop


{{--
// { 'bSortable': false, 'aTargets': [ 1 ] }
    @if($modelItem->hasCustomFilters())
    <div class="row">
        <div class="col-lg-12">
        <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
            <div style="width: 100%; text-align: center; height:30px; margin-bottom: 30px;">
                @foreach ($modelItem->getCustomFilters() as $key => $filter)
                    @if ($filter->getType() == 'dropdown')
                        <div style="display: inline-block; width: 200px; margin-right: 15px;  position: relative; vertical-align: top;">
                            <select id="filter{{$key}}" name="{{$filter->getName()}}" class="form-control input-sm" onchange="processForm(event)">
                                @foreach ($filter->getOptions() as $fKey => $value)
                                    <option value="{{$fKey}}" @if ($fKey == $filter->getValue()) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if ($filter->getType() == 'text')
                        <div style="display: inline-block; width: 200px; margin-right: 15px; height: 30px; position: relative; vertical-align: top;">
                            @if ($filter->isDateFilter())
                                <div class="form-group">
                                    <div class="datepicker form-group input-group" id="datepicker" style="margin-top: -10px;">
                                        <input data-date-picktime="" style="position: absolute; width: 190px; top: 10px; border-radius: 3px; background-color: #fff;" class="form-control input-sm" name="{{$filter->getName()}}" type="text"  placeholder="{{$filter->getTitle()}}" value="{{$filter->getValue()}}" readonly="readonly">
                                        <span class="input-group-addon" style="position: relative; left: 108px; top: 11px; z-index: 10; border: none; border-left: 1px solid #ccc; height: 28px; background-color: #eeeeee; border-radius: 0;">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                        <button class="btn btn-default input-sm" type="submit" style="position: relative; left: 23px; top:11px; z-index:10; border: none; border-left: 1px solid #ccc; height: 28px; background-color: #eeeeee; border-radius: 0;" >
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            @elseif ($filter->getName() == 'price')
                                <input type="text" placeholder="Price" class="form-control input-sm" style=" width: 190px; top: 171px;" name="{{$filter->getName()}}" value="{{$filter->getValue()}}">
                                <button class="btn btn-default input-sm" type="submit" style="position: absolute; line-height: 18px; top: 1px; right: 11px; border: none; border-left: 1px solid #ccc; height: 28px; background-color: #eeeeee; border-radius: 0;" >
                                    <i class="fa fa-search"></i>
                                </button>
                            @else
                                <input type="text" placeholder="Search..." class="form-control input-sm" style="width: 190px; top: 160px;" name="{{$filter->getName()}}" value="{{$filter->getValue()}}">
                                <button class="btn btn-default input-sm" type="submit" style="position: absolute; line-height: 18px; top: 1px; right: 11px; border: none; border-left: 1px solid #ccc; height: 28px; background-color: #eeeeee; border-radius: 0;" >
                                    <i class="fa fa-search"></i>
                                </button>
                            @endif
                        </div>
                    @endif
                    @if($filter->getType() == 'boolDropdown')
                        <div style="display: inline-block; width: 200px; margin-right: 15px;  position: relative; vertical-align: top;">
                            <select id="filter{{$key}}" name="{{$filter->getName()}}" class="form-control input-sm" onchange="processForm(event)">
                                <option value="-1">- {{$filter->getTitle()}} -</option>
                                <option value="1" @if((int)$filter->getValue() == 1) selected @endif>{{$filter->getTrueValueName()}}</option>
                            </select>
                        </div>
                    @endif
                @endforeach
                <a href="#" onclick="resetForm()" style="display:inline-block; vertical-align:top; margin-top:4px;">Reset form</a>
            </div>
        </form>
        </div>
    </div>
    @endif

    <script>
        $(function(){
            jQuery('#dataTable_filter').remove();
            jQuery('#filterForm').on('submit', processForm);
        })
        function processForm (e){
            e.preventDefault();
            var url = jQuery('#filterForm').attr('action').split('?');
            url = url[0]+'?';
            jQuery('#filterForm :input').each(function(){
                if (($(this).val().length !== 0 && $(this).val() != '-1' && typeof($(this).val()) != 'undefined')) {
                    if ($(this).attr('type') != 'submit' && $(this).attr('type') != 'button' && $(this).attr('type') != 'checkbox') {
                        url += this.name + '=' + $(this).val() + '&';
                    }
                    if ($(this).attr('type') == 'checkbox' && $(this).is(':checked')) {
                        url += this.name + '=' + $(this).val() + '&';
                    }
                }
            });
            window.location.replace(url.slice(0, -1));
        }
        function resetForm() {
            var form = jQuery('#filterForm');
            form[0].reset();
            form.find('select').each(function(){
                $(this).val(-1);
            })
        }
    </script>

--}}