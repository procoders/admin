<?php

namespace SleepingOwl\Admin\Filters;


class DateFilter extends BaseCustomFilter {

    protected $type = 'date';

    public function getValue() {
        return \Input::get($this->name);
    }

    protected $rule;

    public function rule($rule) {
        $this->rule = $rule;
        return $this;
    }

    public function getRule() {
        return $this->rule;
    }
}