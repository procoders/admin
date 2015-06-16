<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class EmailGroup extends BaseFormItem
{
	public function render()
	{
        return HtmlBuilder::emailGroupField($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 