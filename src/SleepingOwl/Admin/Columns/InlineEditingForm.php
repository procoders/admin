<?php namespace SleepingOwl\Admin\Columns;

Class InlineEditingForm
{

    public static $current;
    protected $model = NULL;
    protected $form;
    protected $method = NULL;
    protected $title = '';
    protected $items = [];

    public function __construct($model, $method)
    {
        $this->model = $model;
        $this->method = $method;
        //$this->form = new \Form();
    }

    public function getForm()
    {
        return $this->form;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function addField(InlineEditingFormItem $item)
    {
        $this->items[] = $item;
    }

    public function getFields() {
        return $this->fields;
    }

}