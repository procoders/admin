<?php

namespace SleepingOwl\Admin\Columns\Column;

class CountWithTrashed extends Count
{
    public function render($instance, $totalCount)
    {
        $methodName = $this->name;

        $count = count($instance->$methodName()->withTrashed()->get());

        return $this->htmlBuilder->tag('td', $this->getAttributesForCell($instance), $count);
    }

}