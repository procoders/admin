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
        function resetForm() {
            var form = jQuery('#filterForm');
            form[0].reset();
            form.find('select').each(function(){
                $(this).val(-1);
            })
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
        <div class="col-lg-12">
        <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
            <div style="width: 100%; text-align: center; height:30px; margin-bottom: 30px;">
                @foreach ($modelItem->getCustomFilters() as $key => $filter)
                    @if ($filter->getType() == 'dropdown')
                        <div style="display: inline-block; width: 200px; margin-right: 15px">
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
                                    <div class="datepicker form-group input-group" id="datepicker">
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
                        <div style="display: inline-block; width: 200px;">
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
	<div class="row">
		<div class="col-lg-12">
			<a class="btn btn-success navbar-btn" {{ $modelItem->isCreatable() ? '' : 'disabled' }} href="{{{ $newEntryRoute }}}" style="float: right;"><i class="fa fa-plus"></i> {{{ Lang::get('admin::lang.table.new-entry') }}}</a>
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