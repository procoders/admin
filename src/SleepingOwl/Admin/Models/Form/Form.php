<?php namespace SleepingOwl\Admin\Models\Form;

use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Models\Form\FormItem\Checkbox;
use SleepingOwl\Admin\Models\Form\Interfaces\FormItemInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\ViewErrorBag;

/**
 * Class Form
 * @package SleepingOwl\Admin\Models\Form
 */
class Form
{
	/**
	 * @var FormItemInterface[]
	 */
	protected $items;

    protected $inlineItems;
	/**
	 * @var \SleepingOwl\Html\FormBuilder
	 */
	protected $formBuilder;
	/**
	 * @var
	 */
	public $instance;
	/**
	 * @var string
	 */
	protected $method;
	/**
	 * @var string
	 */
	protected $saveUrl;
	/**
	 * @var string
	 */
	protected $backUrl;
	/**
	 * @var ViewErrorBag
	 */
	protected $errors;
	/**
	 * @var array
	 */
	protected $values;

    protected $groups;


	function __construct()
	{
		$this->formBuilder = Admin::instance()->formBuilder;
		$this->items = [];
        $this->inlineItems = [];
        $this->groups = [];
	}

    public function getInlineItems()
    {
        return $this->inlineItems;
    }

	/**
	 * @return mixed
	 */
	public function getInstance()
	{
		return $this->instance;
	}

	/**
	 * @param mixed $instance
	 */
	public function setInstance($instance)
	{
		$this->instance = $instance;
		$this->setDefaults();
	}

    public function addGroup(FormGroup $group)
    {
        $this->groups[$group->getCode()] = $group;
    }

    public function getGroups()
    {
        return $this->groups;
    }

	/**
	 * Set default values for instance
	 */
	public function setDefaults()
	{
		foreach ($this->items as $item)
		{
			$name = $item->getName();
			if ( ! is_null($name) && ! isset($this->instance->$name))
			{
				$this->instance->$name = $item->getDefault();
			}
		}
	}

	/**
	 * @param mixed $method
	 */
	public function setMethod($method)
	{
		$this->method = $method;
	}

	/**
	 * @param mixed $saveUrl
	 */
	public function setSaveUrl($saveUrl)
	{
		$this->saveUrl = $saveUrl;
	}

	/**
	 * @param mixed $errors
	 */
	public function setErrors($errors)
	{
		if (is_null($errors))
		{
			$errors = new ViewErrorBag;
		}
		$this->errors = $errors;
	}

	/**
	 * @param mixed $backUrl
	 */
	public function setBackUrl($backUrl)
	{
		$this->backUrl = $backUrl;
	}

	/**
	 * @return string
	 */
	public function render($sepparateByGroup = false)
	{
		$content = [];
		$content[] = $this->formBuilder->model($this->instance, [
			'method' => $this->method,
			'url'    => $this->saveUrl,
			'errors' => $this->errors,
            'class'  => 'form-horizontal form-bordered'
		]);

        $itemsCollection = [];

        if ($sepparateByGroup === true) {
            $content[] = '<div class="row">';
            foreach($this->groups as $groupCode => $group) {
                $itemsCollection = [];
                foreach ($this->items as $item) {
                    if ($item->getGroup() == $groupCode) {
                        $itemsCollection[] = $item;
                    }
                }
                $content[] = view('admin::model/form_group')
                    ->with('items', $itemsCollection)
                    ->with('group', $group)
                    ->with('displayType', $group->getDisplayType());
            }
            $content[] = '</div>';
        } else {
            foreach ($this->items as $item)
            {
                $content[] = $item->render();
            }
        }

		$content[] = $this->formBuilder->submitGroup($this->backUrl, $sepparateByGroup);
		$content[] = $this->formBuilder->close();

		$response =  implode('', $content);
        return $response;
	}

    /**
     * @return string
     */
    public function renderInline()
    {
        $content = [];

        $id = uniqid();
        $content[] = $this->formBuilder->model($this->instance, [
            'method' => $this->method,
            'url'    => $this->saveUrl,
            'errors' => $this->errors,
            'class'  => 'form-horizontal form-bordered',
            'id' => $id,
            'onsubmit' => 'return inlineFormSubmit(event, \'' . $id . '\');'
        ]);

        foreach ($this->inlineItems as $item)
        {
            if (method_exists($item, 'inlineEdit')) {
                $item->inlineEdit(true);
            }
            $content[] = $item->render();
        }
        if (count($this->inlineItems) == 1) {
            if ($this->inlineItems[0] instanceof Checkbox) {

            } else {
                $content[] = view('admin::model/inline_edit_form_controls')
                    ->with('inline_controls', true);
            }
        } else {
            $content[] = view('admin::model/inline_edit_form_controls')
                ->with('inline_controls', false);
        }
        $content[] = $this->formBuilder->close();

        $response =  implode('', $content);
        return $response;
    }

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}

	/**
	 * @param $values
	 */
	public function setValues($values)
	{
		$this->values = $values;
	}

	public function getValueForName($name)
	{
		return Arr::get($this->values, $name, null);
	}

	public function addItem($item)
	{
		$this->items[] = $item;
	}

    public function addInlineItem($item)
    {
        $this->inlineItems[] = $item;
    }

	public function getValidationRules()
	{
		$rules = [];
		foreach ($this->items as $item)
		{
			$rules[$item->getName()] = $item->getValidationRules();
		}
		return $rules;
	}

    public function getInlineValidationRules()
    {
        $rules = [];
        foreach ($this->inlineItems as $item)
        {
            $rules[$item->getName()] = $item->getValidationRules();
        }
        return $rules;
    }

	public function updateRequestData(&$data)
	{
		foreach ($this->items as $item)
		{
			$item->updateRequestData($data);
		}
	}

}