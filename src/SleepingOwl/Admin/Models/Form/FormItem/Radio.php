<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Radio extends BaseFormItem
{
    use JsValidator;
    use Traits\Addon;

	public function render()
	{
        return ($this->addon)
            ? HtmlBuilder::radioAddon($this->name, $this->label, $this->getValueFromForm(), $this->attributes, $this->addonValue)
            : HtmlBuilder::radio($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes));
	}
} 