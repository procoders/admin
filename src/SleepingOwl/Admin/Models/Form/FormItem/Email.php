<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Email extends BaseFormItem
{
	public function render()
	{
        return HtmlBuilder::emailField($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 