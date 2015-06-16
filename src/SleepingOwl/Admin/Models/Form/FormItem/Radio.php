<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Radio extends BaseFormItem
{

    use Traits\Addon;

	public function render()
	{
        return ($this->addon)
            ? HtmlBuilder::radioAddon($this->name, $this->label, $this->getValueFromForm(), $this->attributes, $this->addonValue)
            : HtmlBuilder::radio($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 