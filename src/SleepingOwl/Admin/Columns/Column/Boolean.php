<?php
namespace SleepingOwl\Admin\Columns\Column;

use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;
use SleepingOwl\Admin\Columns\InlineEditingForm;

class Boolean implements ColumnInterface {

    protected $title;
    protected $name;
    protected $sortable = true;
    protected $inlineForm;

    public function inlineForm(InlineEditingForm $form)
    {
        $this->inlineForm = $form;
        return $this;
    }

    public function getInlineForm()
    {
        return $this;
    }

    public function sortable($value)
    {
        $this->sortable = (bool)$value;
        return $this;
    }

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
        return (string)view('admin::_partials/columns/boolean')
            ->with('value', ((int)$instance->$column == 1) ? true : false)
            ->with('editable', (!is_null($this->inlineForm)))
            ->with('name', $this->name);
    }

    public function isHidden()
    {
        return false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLabel()
    {
        return $this->title;
    }

    public function isSortable()
    {
        return $this->sortable;
    }
}