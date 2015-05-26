<?php

namespace SleepingOwl\Admin\Filters;


class CheckboxFilter extends BaseCustomFilter {

    public function getValue() {
        return \Input::get($this->name);
    }
}