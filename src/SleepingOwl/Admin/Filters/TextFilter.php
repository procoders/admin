<?php

namespace SleepingOwl\Admin\Filters;


class TextFilter extends BaseCustomFilter {

    public function getValue() {
        return \Input::get($this->name);
    }
}