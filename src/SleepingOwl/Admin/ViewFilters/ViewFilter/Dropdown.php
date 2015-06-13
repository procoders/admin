<?php namespace SleepingOwl\Admin\ViewFilters\ViewFilter;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\ViewFilters\Interfaces\ViewFilterInterface;
use SleepingOwl\Admin\Models\ModelItem;
use Illuminate\Support\Collection;

Class Dropdown extends BaseViewFilter
{

    const TYPE = 'dropdown';

    protected $options = [];

    public function render($tableId, $filterUniqueKey)
    {
        return view('admin::_partials/view_filters/dropdown')
            ->with('id', $this->getId($tableId, $filterUniqueKey))
            ->with('name', $this->getName())
            ->with('label', $this->getLabel())
            ->with('value', $this->getValue())
            ->with('options', $this->getOptions());
    }

    public function options($callback)
    {
        $this->options = $callback();
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getFilterType()
    {
        return self::TYPE;
    }

}