<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

class Checkbox extends BaseFormItem
{
	public function render()
	{
		if ($this->getName() == 'active') {
            $this->attributes['checked'] = "checked";
        }
        return $this->formBuilder->checkboxGroup($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 