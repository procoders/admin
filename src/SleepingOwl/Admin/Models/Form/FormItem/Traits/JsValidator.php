<?php namespace SleepingOwl\Admin\Models\Form\FormItem\Traits;

trait JsValidator
{
    public function getOptions($options)
    {
        foreach ($this->getValidationRules() as $rule) {
            if ($rule == 'required') {
                $options['data-parsley-required'] = true;
            } else if (strstr($rule, 'regex')) {
                $regexArray = explode(':', $rule, 2);

                if (isset($regexArray[1]) && $regexArray[1]) {
                    $options['data-parsley-pattern'] = $regexArray[1];
                }
            } else if (strstr($rule, 'email')) {
                $options['data-parsley-type'] = 'email';
            }
        }

        return $options;
    }
}