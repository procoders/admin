<?php namespace SleepingOwl\Admin\ViewFilters\ViewFilter;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\ViewFilters\Interfaces\ViewFilterInterface;
use SleepingOwl\Admin\Models\ModelItem;
use Illuminate\Support\Collection;

Class Date extends BaseViewFilter
{

    const TYPE = 'text';

    protected $rule;

    public function render($tableId, $filterUniqueKey)
    {
        return view('admin::_partials/view_filters/date')
            ->with('id', $this->getId($tableId, $filterUniqueKey))
            ->with('name', $this->getName())
            ->with('label', $this->getLabel())
            ->with('value', $this->getValue())
            ->with('rule', $this->getRule());
    }

    public function getFilterType()
    {
        return self::TYPE;
    }

    public function rule($rule)
    {
        $this->rule = $rule;
        return $this;
    }

    public function getRule()
    {
        return $this->rule;
    }

}