@extends('admin::_layout.inner')

@section('innerContent')
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
    <div class="row">
        <div class="col-lg-12">
            <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
                @foreach ($modelItem->getCustomFilters() as $key => $filter)
                    @if($filter->getType() == 'dropdown')
                        <label for="filter{{$key}}">{{$filter->getTitle()}}
                            <select id="filter{{$key}}" name="{{$filter->getName()}}" onchange="document.getElementById('filterForm').submit()" class="form-control input-sm">
                                @foreach ($filter->getOptions() as $key => $value)
                                    <option value="{{$key}}" @if ($key == $filter->getValue()) selected @endif >{{$value}}</option>
                                @endforeach
                            </select>
                        </label>
                    @endif
                    @if($filter->getType() == 'checkbox')
                        <label for="filter{{$key}}">{{$filter->getTitle()}}</label>
                        <input type="checkbox" name="{{$filter->getName()}}" value='1' @if ($filter->getValue() == '1')) checked="checked" @endif onchange="document.getElementById('filterForm').submit()" >
                    @endif
                @endforeach
                
            </form>
        </div>
    </div>
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