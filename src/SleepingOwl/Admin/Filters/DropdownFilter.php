<?php

namespace SleepingOwl\Admin\Filters;

Class DropdownFilter extends BaseCustomFilter {

    public function getOptions() {
        $repository = $this->model;
        return $repository::getOptionsList();
    }

    public function getValue() {
        return \Input::get($this->name);
    }
}