<?php

namespace SleepingOwl\Admin\Columns\Column;


class Checkbox extends BaseColumn {

    public function render($instance, $totalCount = null)
    {
        $name = $instance->getTable();
        $id = $instance->id;
        $checkbox = '<input type="checkbox" name="' . $name . '" value="' . $id . '" />';
        return $this->htmlBuilder->tag('td', ['class' => 'text-right'], $checkbox);
    }

    public function isBatchAction()
    {
        return true;
    }

    public function isSortable()
    {
        return false;
    }
}