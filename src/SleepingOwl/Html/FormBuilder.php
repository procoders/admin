<?php namespace SleepingOwl\Html;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Html\FormBuilder as IlluminateFormBuilder;
use Illuminate\Support\ViewErrorBag;
use Lang;
use SleepingOwl\DateFormatter\DateFormatter;
use SleepingOwl\Models\Interfaces\ModelWithFileFieldsInterface;
use SleepingOwl\Models\Interfaces\ModelWithImageFieldsInterface;

/**
 * Class FormBuilder
 */
class FormBuilder extends IlluminateFormBuilder
{
	/**
	 * @var ViewErrorBag
	 */
	protected $errors;

	/**
	 * @param array $options
	 * @return string
	 */
	public function open(array $options = [])
	{
		$this->errors = array_get($options, 'errors');
		array_forget($options, 'errors');
		array_set($options, 'files', true);
		return parent::open($options);
	}

	/**
	 * Append element label and error label to form element and wrap it with div
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $formElement
	 * @return string
	 */
	protected function makeGroup($name, $label, $formElement)
	{
		$content = '';
		$content .= $this->label($name, $label);
		$content .= $formElement;
		return $this->wrapContent($name, $content);
	}

	/**
	 * Append error label to element and wrap it with div
	 *
	 * @param string $name
	 * @param string $content
	 * @return string
	 */
	protected function wrapContent($name, $content)
	{
		$content .= $this->errors->first($name, $this->getErrorTemplate());
		$class = $this->getErrorClass($name);
		return $this->wrapGroup($content, compact('class'));
	}

	/**
	 * Wrap content with div
	 *
	 * @param string $content
	 * @param array $options
	 * @return string
	 */
	protected function wrapGroup($content, array $options = [])
	{
		$options = $this->addClassToOptions($this->getFormGroupClass(), $options);
		return $this->html->tag('div', $options, $content);
	}

	/**
	 * Add class to attributes array
	 *
	 * @param string $classToAdd
	 * @param array $options
	 * @return array
	 */
	protected function addClassToOptions($classToAdd, array $options = [])
	{
		$class = array_get($options, 'class', '');
		if (is_array($class))
		{
			$class[] = $classToAdd;
		} elseif ( ! empty($class))
		{
			$class .= ' ' . $classToAdd;
		} else
		{
			$class = $classToAdd;
		}
		array_set($options, 'class', $class);
		return $options;
	}

	/**
	 * @param $name
	 * @param null $value
	 * @param array $options
	 * @return string
	 */
	public function labelWithoutEscaping($name, $value = null, $options = [])
	{
		$this->labels[] = $name;

		$options = $this->html->attributes($options);

		$value = $this->formatLabel($name, $value);

		return '<label for="' . $name . '"' . $options . '>' . $value . '</label>';
	}

	/**
	 * @param $name
	 * @param $label
	 * @param $model
	 * @param array $options
	 * @return mixed
	 */
	public function imageGroup($name, $label, ModelWithImageFieldsInterface $model, array $options = [])
	{
		$options = $this->updateOptions($options);
		$content = '';
		if ($model->$name->exists())
		{
			$img = $this->html->tag('img', [
				'class'       => 'thumbnail',
				'src'         => $model->$name->thumbnail('admin_preview'),
				'width'       => '80px',
				'data-toggle' => 'tooltip',
				'title'       => $model->$name->info()
			]);
			$innerContent = $this->html->tag('a', [
				'href'        => $model->$name->thumbnail('original'),
				'data-toggle' => 'lightbox'
			], $img);
			$innerContent .= $this->html->tag('a', [
				'href'      => '#',
				'class'     => 'img-delete',
				'data-name' => $name,
			], '<i class="fa fa-times"></i> ' . Lang::get('admin::lang.table.delete'));
			$innerContent .= '<div class="clearfix"></div>';
			$content .= $this->html->tag('div', ['class' => 'img-container'], $innerContent);
		}
		$content .= $this->file($name, null, $options);
		return $this->makeGroup($name, $label, $content);
	}

	/**
	 * @param $name
	 * @param $label
	 * @param ModelWithFileFieldsInterface $model
	 * @param array $options
	 * @return mixed
	 */
	public function fileGroup($name, $label, ModelWithFileFieldsInterface $model, array $options = [])
	{
		$options = $this->updateOptions($options);
		$content = '';
		if ($model->$name->exists())
		{
			$link = $this->html->tag('a', [
				'href'        => $model->$name->link(),
				'title'       => Lang::get('admin::lang.table.download'),
				'data-toggle' => 'tooltip'
			], '<i class="fa fa-fw fa-file-o"></i> ' . $model->$name->info());
			$file = $this->html->tag('div', ['class' => 'thumbnail file-info'], $link);
			$content .= $this->html->tag('div', [], $file);
		}
		$content .= $this->file($name, null, $options);
		return $this->makeGroup($name, $label, $content);
	}

	/**
	 * @param $cancelUrl
	 * @return mixed
	 */
	public function submitGroup($cancelUrl)
	{
        return view('admin::_partials/form_elements/actions')
            ->with('cancelUrl', $cancelUrl);

	}

	/**
	 * @param string $name
	 * @param array $attributes
	 * @return null|string
	 */
	public function getIdAttribute($name, $attributes)
	{
		if ($id = parent::getIdAttribute($name, $attributes))
		{
			return $id;
		}
		if (Arr::get($attributes, 'type') !== 'hidden')
		{
			return $name;
		}
		return null;
	}

	/**
	 * @return mixed
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @return string
	 */
	protected function getFormGroupClass()
	{
		return 'form-group';
	}

	/**
	 * @param array $options
	 * @return array
	 */
	protected function updateOptions($options = [])
	{
		return $this->addClassToOptions('form-control', $options);
	}

	/**
	 * @return string
	 */
	protected function getErrorTemplate()
	{
		return '<p class="help-block">:message</p>';
	}

	/**
	 * @param $name
	 * @return array
	 */
	protected function getErrorClass($name)
	{
		$class = [];
		if ($this->errors->has($name))
		{
			$class[] = 'has-error';
		}
		return $class;
	}

}