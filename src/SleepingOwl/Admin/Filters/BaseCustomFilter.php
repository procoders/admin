<?php

namespace SleepingOwl\Admin\Filters;


Class BaseCustomFilter {

    protected $name;

    protected $title;

    protected $model;

    protected $type;

    protected $method;

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

    public function type($type) {
        $this->type = $type;
        return $this;
    }

    public function method($method) {
        $this->method = $method;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getModel() {
        return $this->model;
    }

    public function getType() {
        return $this->type;
    }
}