<?php


namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Admin\AssetManager\AssetManager;

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

        AssetManager::addScript('/adm/js/bootstrap-number-input.js');
        return view('admin/hotel/form/number')
            ->with('column', $this->column)
            ->with('value', $model->$value)
            ->with('name', $this->name)
            ->with('label', $this->label)
            ->with('minValue', $this->minValue)
            ->with('maxValue', $this->maxValue);
    }
}