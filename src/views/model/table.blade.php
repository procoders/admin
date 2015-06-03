@extends('admin::_layout.inner')

@section('innerContent')
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
    </script>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				{{{ $title }}}
				@if(isset($subtitle))
					({{{ $subtitle }}})
				@endif
			</h1>
			@if(Session::has('message'))
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Session::get('message') }}
				</div>
			@endif
		</div>
	</div>
    @if($modelItem->hasCustomFilters())
        <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
            <div style="width: 100%; margin-bottom: 20px;">
                @foreach ($modelItem->getCustomFilters() as $key => $filter)
                    @if ($filter->getType() == 'dropdown' && $filter->getName() != 'adults' && !$filter->getName() != 'child')
                        <div style="display: inline-block; width: 200px; margin-right: 15px">
                            <select id="filter{{$key}}" name="{{$filter->getName()}}" class="form-control input-sm" onchange="processForm(event)">
                                @foreach ($filter->getOptions() as $key => $value)
                                    <option value="{{$key}}" @if ($key == $filter->getValue()) selected @endif >{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if ($filter->getType() == 'text')
                        <div style="display: inline-block; width: 200px; margin-right: 20px">
                            <input type="text" placeholder="Search..." class="form-control input-sm" style="position: absolute; width: 190px;" name="{{$filter->getName()}}" value="{{$filter->getValue()}}">
                            <button class="btn btn-default input-sm" type="submit" style="position: relative; left:150px; border: none; border-left: 1px solid #ccc; height: 28px; top: 1px; border-radius: 3px 0px 0px 3px;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    @endif
                    @if($filter->getType() == 'checkbox')
                        <div style="display: inline-block; width: 200px; position: absolute;">
                            <label for="filter{{$key}}" style="font-weight: normal; font-size: 12px; display: block;">{{$filter->getTitle()}}</label>
                            <input type="checkbox" name="{{$filter->getName()}}" value="1" @if((int)$filter->getValue() == 1) checked="checked" @endif style="position: relative; top: -10px; left:23px;" onchange="processForm(event)">

                        </div>
                    @endif
                @endforeach
            </div>
        </form>
    @endif
	<div class="row">
		<div class="col-lg-12">
			<a class="btn btn-primary navbar-btn" {{ $modelItem->isCreatable() ? '' : 'disabled' }} href="{{{ $newEntryRoute }}}"><i class="fa fa-plus"></i> {{{ Lang::get('admin::lang.table.new-entry') }}}</a>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="dataTable" {!! $modelItem->renderTableAttributes() !!}>
					<thead>
						<tr>
							@foreach ($columns as $column)
                                {!! $column->renderHeader() !!}
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach ($rows as $row)
							<tr>
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
@stop