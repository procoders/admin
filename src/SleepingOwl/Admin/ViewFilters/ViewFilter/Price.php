<?php namespace SleepingOwl\Admin\ViewFilters\ViewFilter;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\ViewFilters\Interfaces\ViewFilterInterface;
use SleepingOwl\Admin\Models\ModelItem;
use Illuminate\Support\Collection;

Class Price extends BaseViewFilter
{

    const TYPE = 'text';

    public function render($tableId, $filterUniqueKey)
    {
        return view('admin::_partials/view_filters/price')
            ->with('id', $this->getId($tableId, $filterUniqueKey))
            ->with('name', $this->getName())
            ->with('label', $this->getLabel())
            ->with('value', $this->getValue());
    }

    public function getFilterType()
    {
        return self::TYPE;
    }

}