<?php namespace SleepingOwl\Admin\ViewFilters\ViewFilter;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\ViewFilters\Interfaces\ViewFilterInterface;
use SleepingOwl\Admin\Models\ModelItem;
use Illuminate\Support\Collection;

Class Bool extends BaseViewFilter
{

    const TYPE = 'bool';

    protected $trueValue = [
        'id' => 1,
        'name' => 'True'
    ];

    protected $falseValue = [
        'id' => 0,
        'name' => 'False'
    ];

    public function render($tableId, $filterUniqueKey)
    {
        return view('admin::_partials/view_filters/bool')
            ->with('id', $this->getId($tableId, $filterUniqueKey))
            ->with('name', $this->getName())
            ->with('label', $this->getLabel())
            ->with('trueValue', $this->trueValue)
            ->with('falseValue', $this->falseValue);
    }

    public function trueValue($id, $name)
    {
        $this->trueValue = [
            'id' => $id,
            'name' => $name
        ];
        return $this;
    }

    public function falseValue($id, $name)
    {
        $this->falseValue = [
            'id' => $id,
            'name' => $name
        ];
        return $this;
    }

    public function getFilterType()
    {
        return self::TYPE;
    }

}