<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Date extends BaseTime
{
    use JsValidator;

	public function render()
	{
        return HtmlBuilder::date($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes));
	}

	public function getValidationRules()
	{
		$rules = parent::getValidationRules();
		$rules[] = 'date:locale';
		return $rules;
	}
} 