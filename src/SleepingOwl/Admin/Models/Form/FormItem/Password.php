<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Password extends BaseFormItem
{
    use JsValidator;

	public function render()
	{
        return HtmlBuilder::password($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes));
	}
} 