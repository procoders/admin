<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

use SleepingOwl\Html\HtmlBuilder;

class Text extends BaseFormItem
{

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
            ? HtmlBuilder::textWithActions($this->name, $this->label, $this->getValueFromForm(), $this->attributes, $this->actions)
            : HtmlBuilder::text($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
} 