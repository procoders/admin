<?php


namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Admin\AssetManager\AssetManager;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Html\HtmlBuilder;

Class Number extends BaseFormItem {

    /**
     * @var string
     */
    protected $column;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var integer
     */
    protected $minValue;

    /**
     * @var integer
     */
    protected $maxValue;

    /**
     * @param $value
     * @return $this
     */
    public function column($value)
    {
        $this->column = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function label($value)
    {
        $this->label = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function minValue($value)
    {
        $this->minValue = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function maxValue($value)
    {
        $this->maxValue = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function render()
    {
        $model = $this->form->instance;
        $value = $this->column;

        $oldInputValue = Admin::$instance->formBuilder->getSessionStore()->getOldInput($value);
        if (! $oldInputValue) {
            $inputValue = $model->$value;
        } else {
            $inputValue = $oldInputValue;
        }

        $options = [
            'data-min-value' => $this->minValue,
            'data-max-value' => $this->maxValue
        ];


        HtmlBuilder::number($this->name, $this->label, (int)$inputValue, $options);
    }

}