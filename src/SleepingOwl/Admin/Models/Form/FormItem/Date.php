<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Date extends BaseTime
{
	public function render()
	{
        return HtmlBuilder::date($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}

	public function getValidationRules()
	{
		$rules = parent::getValidationRules();
		$rules[] = 'date:locale';
		return $rules;
	}
} 