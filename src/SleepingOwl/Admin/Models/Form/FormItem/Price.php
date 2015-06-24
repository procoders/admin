<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Price extends BaseFormItem
{
    use JsValidator;

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
        return HtmlBuilder::price($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes), $this->currency);
	}
} 