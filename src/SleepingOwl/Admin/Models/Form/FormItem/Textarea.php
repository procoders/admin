<?php namespace SleepingOwl\Admin\Models\Form\FormItem;

class Textarea extends BaseFormItem
{
    const EDITOR_WYSIHTML = 'WISYHTML';

    protected $availableEditors = [
        self::EDITOR_WYSIHTML
    ];

    protected $editor = NULL;

    public function editor($editor)
    {
        if (in_array($editor, $this->availableEditors)) {
            $this->editor = $editor;
        }
        return $this;
    }

    public function getEditor()
    {
        return $this->editor;
    }

	public function render()
	{

        if (!is_null($this->editor)) {
            $this->attributes['data-editor'] = $this->editor;
        }

		return $this->formBuilder->textareaGroup($this->name, $this->label, $this->getValueFromForm(), $this->attributes);
	}
}