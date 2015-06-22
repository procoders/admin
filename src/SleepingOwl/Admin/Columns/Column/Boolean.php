<?php
namespace SleepingOwl\Admin\Columns\Column;

class Boolean extends BaseColumn {

    public function valueFromInstance($instance, $name)
    {
        $value = parent::valueFromInstance($instance, $name);
        return (string)view('admin::_partials/columns/boolean')
            ->with('value', (($value == 1) ? true : false));
    }

}