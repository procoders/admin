<?php

namespace SleepingOwl\Admin\Filters;

Class DropdownFilter extends BaseCustomFilter {


    protected $depsOn = [];

    protected $depsPresent = false;

    public function __construct($depsOn = null, $value = null)
    {
        //dd($depsOn);
        if (isset($depsOn) && isset($value)) {
            $this->depsOn['depsOn'] = $depsOn;
            $this->depsOn['value'] = $value;
            $this->depsPresent = true;
        }

    }

    public function getOptions() {
        $repository = $this->model;
        if ($this->depsPresent) {
            return $repository::getOptionsList($this->depsOn['depsOn'], $this->depsOn['value']);
        } else {
            return $repository::getOptionsList();
        }
    }

    public function getValue() {
        return \Input::get($this->name);
    }
}