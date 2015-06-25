<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Checkbox extends BaseFormItem
{
    use JsValidator;
    use Traits\Addon;

	public function render()
	{
        $value = $this->getValueFromForm();

        if (!empty($value))
            $this->attributes['checked'] = 'checked';
        else
            $value = 1;

        return ($this->addon)
            ? HtmlBuilder::checkboxAddon($this->name, $this->label, $value, $this->attributes, $this->addonValue)
            : HtmlBuilder::checkbox($this->name, $this->label, $value, $this->getOptions($this->attributes));
	}
} 