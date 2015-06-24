<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Models\Form\FormItem\Traits\JsValidator;

class Text extends BaseFormItem
{
    use JsValidator;

    protected $actionButton;
    protected $actions = [];

    public function actionButton($val)
    {
        $this->actionButton = (bool)$val;
        return $this;
    }

    public function getActionButton()
    {
        return $this->action;
    }

    public function addAction($title, $link, $onClick = '', $separated = false)
    {
        $this->actions[] = [
            'title' => $title,
            'link' => $link,
            'on-click' => $onClick,
            'separated' => false
        ];
        return $this;
    }

    public function render()
	{
        return ($this->actionButton === true)
            ? HtmlBuilder::textWithActions($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes), $this->actions)
            : HtmlBuilder::text($this->name, $this->label, $this->getValueFromForm(), $this->getOptions($this->attributes));
	}
}