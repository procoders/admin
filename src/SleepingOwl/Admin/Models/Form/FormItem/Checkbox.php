<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Checkbox extends BaseFormItem
{

    use Traits\Addon;

	public function render()
	{
        return ($this->addon)
            ? HtmlBuilder::checkboxAddon($this->name, $this->label, $this->getValueFromForm(), $this->attributes, $this->addonValue)
            : HtmlBuilder::checkbox($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 