<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Password extends BaseFormItem
{
	public function render()
	{
        return HtmlBuilder::password($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 