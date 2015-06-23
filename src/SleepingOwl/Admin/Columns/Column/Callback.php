<?php
namespace SleepingOwl\Admin\Columns\Column;

class Callback extends BaseColumn {

    protected $contentCallback;
    protected $dataValueCallback;

    public function contentCallback($callback)
    {
        $this->contentCallback = $callback;
        return $this;
    }

    public function dataValueCallback($callback)
    {
        $this->dataValueCallback = $callback;
        return $this;
    }


    public function valueFromInstance($instance, $name)
    {
        $callback = $this->contentCallback;
        return $callback($instance);
    }

    public function getValue($instance, $name)
    {
        $callback = (!is_null($this->dataValueCallback)) ? $this->dataValueCallback : $this->contentCallback;

        return $callback($instance);
    }

}