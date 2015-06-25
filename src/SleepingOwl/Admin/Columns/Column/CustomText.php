<?php

namespace SleepingOwl\Admin\Columns\Column;

use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;

Class CustomText extends BaseColumn {
    /**
     * @var string
     */
    protected $modelMethod;

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

}