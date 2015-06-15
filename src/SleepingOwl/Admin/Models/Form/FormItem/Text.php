<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Text extends BaseFormItem
{
	public function render()
	{
        return HtmlBuilder::text($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 