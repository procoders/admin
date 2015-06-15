<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Checkbox extends BaseFormItem
{
	public function render()
	{
        return HtmlBuilder::checkbox($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 