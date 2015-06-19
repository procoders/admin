<?php
namespace SleepingOwl\Admin\Columns\Column;

use App\AdminCustom\Helpers\Admin;
use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;
use SleepingOwl\Admin\Columns\InlineEditingForm;
use SleepingOwl\Admin\Models\Form\FormItem;
use SleepingOwl\Admin\Models\ModelItem;

class Boolean implements ColumnInterface {

    protected $title;
    protected $name;
    protected $sortable = true;
    protected $inlineEdit = false;

    public function inlineEdit($val)
    {
        $this->inlineEdit = (bool)$val;
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
        $reflect = new \ReflectionClass($instance);
        $column = $this->name;
        return (string)view('admin::_partials/columns/boolean')
            ->with('value', ((int)$instance->$column == 1) ? true : false)
            ->with('editable', (bool)$this->inlineEdit)
            ->with('modelName', strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $reflect->getShortName())))
            ->with('attributes', $instance->getAttributes())
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