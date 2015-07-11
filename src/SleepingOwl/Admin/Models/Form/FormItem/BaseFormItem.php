<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Exceptions\MethodNotFoundException;
use SleepingOwl\Html\FormBuilder;
use SleepingOwl\Admin\Models\Form\Interfaces\FormItemInterface;
use SleepingOwl\Admin\Models\Form\Form;
use SleepingOwl\Admin\Models\ModelItem;

/**
 * Class BaseFormItem
 * @package SleepingOwl\Admin\Models\Form\FormItem
 * @method $this default($value)
 */
abstract class BaseFormItem implements FormItemInterface
{
	/**
	 * @var FormBuilder
	 */
	protected $formBuilder;
	/**
	 * @var Form
	 */
	protected $form;
	/**
	 * @var string
	 */
	protected $name;

    protected $value = NULL;

	/**
	 * @var string
	 */
	protected $label;
	/**
	 * @var array
	 */
	protected $validation = [];

	/**
	 * @var array
	 */
	protected $attributes = [];

    protected $group;

	/**
	 * @var mixed
	 */
	protected $default = null;

    protected $inlineEdit = false;

    public function inlineEdit($val)
    {
        $this->inlineEdit = (bool)$val;

        if ($this->inlineEdit === true) {
            $this->attributes['inline-edit'] = true;
        }

        return $this;
    }

    public function group($code)
    {
        $this->group = $code;
        return $this;
    }

    public function getGroup()
    {
        return $this->group;
    }

	/**
	 * @param null $name
	 * @param null $label
	 */
	function __construct($name = null, $label = null)
	{

		$this->formBuilder = Admin::instance()->formBuilder;
		$this->label = $label;
		$this->name = $name;
		if ($modelItem = ModelItem::$current)
		{
			$this->form = $modelItem->getForm();
		}
	}

    public function name($name)
    {
        $this->name = (string)$name;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	protected function getValueFromForm()
	{
        $value = $this->form->getValueForName($this->name);

		if (is_null($value) && !empty($this->form)) {
            $model = $this->form->instance;
            if (!is_null($model)) {
                $name = $this->name;
                $value = $model->$name;
                $oldInput = $this->formBuilder->getSessionStore()->getOldInput($name);
                if (!is_null($oldInput)) {
                    $value = $oldInput;
                }
            }
        }
        return $value;
	}

	public function required($onlyOnCreate = false)
	{
		if ($onlyOnCreate)
		{
			$this->validationRule('required_only_on_create');
		} else
		{
			$this->validationRule('required');
		}
		return $this;
	}

	public function unique()
	{
		$table = ModelItem::$current->getModelTable();
		return $this->validationRule('unique:' . $table . ',' . $this->name);
	}

	public function validationRule($rule)
	{
		$rules = explode('|', $rule);
		foreach ($rules as $rule)
		{
			$this->validation[] = $rule;
		}
		return $this;
	}

	public function getValidationRules()
	{
		return $this->validation;
	}

	public function attributes($attributes)
	{
		$this->attributes = $attributes;
	}

	function __call($name, $arguments)
	{
		if ($name == 'default')
		{
			return call_user_func_array([$this, 'setDefault'], $arguments);
		}
		throw new MethodNotFoundException(get_class($this), $name);
	}

	/**
	 * @param mixed $default
	 * @return $this
	 */
	public function setDefault($default)
	{
		$this->default = $default;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDefault()
	{
		return $this->default;
	}

	/**
	 * @param array $data
	 */
	public function updateRequestData(&$data)
	{

	}

}