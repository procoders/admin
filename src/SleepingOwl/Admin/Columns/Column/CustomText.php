<?php

namespace SleepingOwl\Admin\Columns\Column;

use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;

Class CustomText implements ColumnInterface {
    /**
     * @var string
     */
    protected $modelMethod;

    /**
     * @var string
     */
    protected $label;

    protected $sortable = true;

    public function sortable($value)
    {
        $this->sortable = (bool)$value;
        return $this;
    }

    /**
     * @param $method
     * @return $this
     */
    public function modelMethod($method)
    {
        $this->modelMethod = $method;

        return $this;
    }

    /**
     * @param $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function renderHeader()
    {
        return '<th data-sortable="false" style="width: 100px;">' . $this->label . '</th>';
    }

    /**
     * @param $instance
     * @param int $totalCount
     * @return string
     */
    public function render($instance, $totalCount)
    {
        $method = $this->modelMethod;

        return (string)view('admin/hotel/custom_text')->with('text', $instance->$method());
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'custom_text';
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function isSortable()
    {
        return $this->sortable;
    }
}