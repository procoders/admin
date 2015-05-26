<?php

namespace SleepingOwl\Admin\Filters;


class DateFilter extends BaseCustomFilter {

    public function getValue() {
        return \Input::get($this->name);
    }
}