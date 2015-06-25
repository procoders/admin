<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Color extends BaseFormItem
{
    use JsValidator;

	public function render()
	{
		return HtmlBuilder::color($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes));
	}
} 