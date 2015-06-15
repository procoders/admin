<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Color extends BaseFormItem
{

	public function render()
	{
		return HtmlBuilder::color($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 