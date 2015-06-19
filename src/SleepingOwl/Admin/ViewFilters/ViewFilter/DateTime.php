<?php namespace SleepingOwl\Admin\ViewFilters\ViewFilter;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use SleepingOwl\Html\HtmlBuilder;

Class DateTime extends BaseViewFilter
{

    const TYPE = 'datetime';

    protected $rule;

    public function render($tableId, $filterUniqueKey)
    {
        return HtmlBuilder::datetime(
            $this->getName(),
            $this->getLabel(),
            $this->getValue(),
            ['id' => $this->getId($tableId, $filterUniqueKey)],
            $this->getRule()
        );
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

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

}