<?php
namespace SleepingOwl\Admin\Columns\Column;

use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;

class Boolean implements ColumnInterface {

    protected $title;
    protected $name;

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    public function renderHeader()
    {
        return '<th style="width: 100px !important;">' . $this->title . '</th>';
    }

    public function render($instance, $totalCount)
    {
        $column = $this->name;
        return (string)view('admin/hotel/list/boolean-column')
            ->with('value', ((int)$instance->$column == 1) ? true : false);
    }

    public function isHidden()
    {
        return false;
    }

    public function getName()
    {
        return $this->name;
    }
}