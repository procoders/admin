<?php

namespace SleepingOwl\Admin\Filters;

Class DropdownFilter extends BaseCustomFilter {

    protected $name;

    protected $title;

    protected $model;

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function title($title) {
        $this->title = $title;
        return $this;
    }

    public function model($model) {
        $this->model = $model;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getOptions() {
        $repository = $this->model;
        return $repository::getOptionsList();
    }

    public function getValue() {
        return \Input::get($this->name);
    }
}