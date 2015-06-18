<?php namespace SleepingOwl\Admin\Columns;

Class InlineEditingFormItem
{

    protected $name;
    protected $title;
    protected $type;

    public function __construct($name, $title, $type)
    {
        $this->name = $name;
        $this->title = $title;
        $this->type = $type;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getType()
    {
        return $this->type;
    }

}