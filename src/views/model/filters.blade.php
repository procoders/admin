<?php
    AssetManager::addScript('admin::js/bootstrap-datepicker.js');
    AssetManager::addStyle('admin::css/datepicker.css');
?>
<div class="row">
    <div class="col-lg-12">
        <form action="{{$_SERVER['REQUEST_URI']}}" id="filterForm" method="GET">
            <div class="filter-wrapper">
                @foreach ($modelItem->getCustomFilters() as $key => $filter)
                    @if ($filter->getType() == 'dropdown')
                        <div class="dropdown">
                            <select id="{{$tableId}}-dropdown-{{$key}}" data-live-search="true" data-style="btn-white" name="{{$filter->getName()}}" class="form-control selectpicker input-sm" data-sequance="{{$filter->getColumnSequenceNumber()}}">
                                @foreach ($filter->getOptions() as $fKey => $value)
                                    <option value="{{(($fKey == -1) ? '' : $value)}}"  @if ($fKey == $filter->getValue()) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif ($filter->getType() == 'text')
                        <div class="text">
                            @if ($filter->getName() == 'price')
                                <input type="text" placeholder="Price" class="form-control input-sm text" id="{{$tableId}}-price-{{$key}}" name="{{$filter->getName()}}" value="{{$filter->getValue()}}" data-sequance="{{$filter->getColumnSequenceNumber()}}">
                            @else
                                <input type="text" placeholder="Search..." class="form-control input-sm text" id="{{$tableId}}-text-{{$key}}" name="{{$filter->getName()}}" value="{{$filter->getValue()}}" data-sequance="{{$filter->getColumnSequenceNumber()}}">
                            @endif
                        </div>
                    @elseif ($filter->getType() == 'date')
                        <div class="date">
                            <div class="form-group">
                                <div class="datepicker form-group input-group">
                                    <input data-date-picktime="" id="{{$tableId}}-date-{{$key}}" class="form-control input-sm input-date" id="{{$tableId}}-date-{{$key}}" name="{{$filter->getName()}}" type="text"  placeholder="{{$filter->getTitle()}}" value="{{$filter->getValue()}}" readonly="readonly" data-sequance="{{$filter->getColumnSequenceNumber()}}" data-rule="{{$filter->getRule()}}">
                                </div>
                            </div>
                        </div>
                    @elseif($filter->getType() == 'boolDropdown')
                        <div style="display: inline-block; width: 200px; margin-right: 15px;  position: relative; vertical-align: top;">
                            <select name="{{$filter->getName()}}" data-live-search="true" data-style="btn-white" class="selectpicker form-control input-sm" id="{{$tableId}}-bool-{{$key}}" data-sequance="{{$filter->getColumnSequenceNumber()}}">
                                <option value="-1">- {{$filter->getTitle()}} -</option>
                                <option value="1" @if((int)$filter->getValue() == 1) selected @endif>{{$filter->getTrueValueName()}}</option>
                            </select>
                        </div>
                    @endif
                @endforeach
                <a href="#" id="reset-{{$tableId}}" class="reset">Reset form</a>
            </div>
        </form>
    </div>
</div>