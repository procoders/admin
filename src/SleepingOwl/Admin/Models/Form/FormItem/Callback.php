<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

class Callback extends BaseFormItem
{

    protected $callback;

    public function callback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    public function render()
    {
        if (is_null($this->callback))
            return '';

        $callback = $this->callback;
        return $callback($this->form->instance);
    }

}