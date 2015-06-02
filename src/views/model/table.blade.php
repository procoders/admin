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
        <div class="row">
            <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
                <div class="col-md-11">
                    @foreach ($modelItem->getCustomFilters() as $key => $filter)
                        @if($filter->getType() == 'dropdown' && $filter->getName() != 'adults' && !$filter->getName() != 'child')
                            <label for="filter{{$key}}">{{$filter->getTitle()}}
                                <select id="filter{{$key}}" name="{{$filter->getName()}}" class="form-control input-sm">
                                    @foreach ($filter->getOptions() as $key => $value)
                                        <option value="{{$key}}" @if ($key == $filter->getValue()) selected @endif >{{$value}}</option>
                                    @endforeach
                                </select>
                            </label>
                        @endif
                        @if ($filter->getType() == 'text')
                            <label for="filter{{$key}}">{{$filter->getTitle()}}
                                <div>
                                    <input type="text" name="{{$filter->getName()}}" value="{{$filter->getValue()}}" class="form-control input-sm">
                                </div>
                            </label>
                        @endif
                        @if($filter->getType() == 'checkbox')
                            <label for="filter{{$key}}" style="text-align: center;">{{$filter->getTitle()}}
                                <div>
                                    <input type="checkbox" name="{{$filter->getName()}}" value="1" checked="checked">
                                </div>
                            </label>
                        @endif
                        @if($filter->getType() == 'date')
                            <div class="form-group">
                                <label for="{{$filter->getName()}}">{{$filter->getTitle()}}</label>
                                <div class="datepicker form-group input-group">
                                    <input data-date-picktime="" class="form-control" name="{{$filter->getName()}}" type="text"  id="{{$filter->getName()}}" placeholder="{{$filter->getTitle()}}" value="{{$filter->getValue()}}" readonly="readonly">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if($filter->getName() == 'adults' || $filter->getName() == 'child')
                            <label for="filter{{$key}}">{{$filter->getTitle()}}
                                <select id="filter{{$key}}" name="{{$filter->getName()}}" class="form-control input-sm">
                                    @foreach ($filter->getOptions() as $key => $value)
                                        @if ($key == $filter->getValue())
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @elseif ($filter->getName() == 'adults' && $key == '1')
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-1" style="text-align: right; margin-top: 20px;">
                    <input type="submit" value="Search" class="btn btn-primary">
                </div>
            </form>
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