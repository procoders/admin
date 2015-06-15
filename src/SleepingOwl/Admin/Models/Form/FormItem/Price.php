<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Price extends BaseFormItem
{

    protected $currency = '$';

    public function currency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

	public function render()
	{
        return
            HtmlBuilder::color('test', 'test', '#6666ff') .
            HtmlBuilder::price($this->name, $this->label, $this->getValueFromForm(), $this->attributes, $this->currency);
	}
} 