<?php

namespace SleepingOwl\Admin\Filters;


class TextFilter extends BaseCustomFilter {


    protected $isDateFilter;

    public function getValue() {
        return \Input::get($this->name);
    }

    public function dateFilter($isDateFilter) {
        $this->isDateFilter = $isDateFilter;
        return $this;
    }

    public function isDateFilter()
    {
        return $this->isDateFilter;
    }
}