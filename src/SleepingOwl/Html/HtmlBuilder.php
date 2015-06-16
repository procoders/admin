<?php namespace SleepingOwl\Html;

use Illuminate\Html\HtmlBuilder as IlluminateHtmlBuilder;
use SleepingOwl\DateFormatter\DateFormatter;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\AssetManager\AssetManager;

/**
 * Class HtmlBuilder
 */
class HtmlBuilder extends IlluminateHtmlBuilder
{
	/**
	 * @var string[]
	 */
	protected $tagsWithoutContent = [
		'input',
		'img',
		'br',
		'hr'
	];

	/**
	 * @param $tag
	 * @param array $attributes
	 * @param string $content
	 * @return string
	 */
	public function tag($tag, $attributes = [], $content = null)
	{
		return $this->getOpeningTag($tag, $attributes) . $content . $this->getClosingTag($tag);
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	protected function attributeElement($key, $value)
	{
		if (is_array($value))
		{
			$value = implode(' ', $value);
		}
		return parent::attributeElement($key, $value);
	}

	/**
	 * @param $tag
	 * @param array $attributes
	 * @return string
	 */
	protected function getOpeningTag($tag, array $attributes)
	{
		$result = '<' . $tag;
		if ( ! empty($attributes))
		{
			$result .= $this->attributes($attributes);
		}
		if ($this->isTagNeedsClosingTag($tag))
		{
			$result .= '>';
		}
		return $result;
	}

	/**
	 * @param $tag
	 * @return string
	 */
	protected function getClosingTag($tag)
	{
		$closingTag = '/>';
		if ($this->isTagNeedsClosingTag($tag))
		{
			$closingTag = '</' . $tag . '>';
		}
		return $closingTag;
	}

	/**
	 * @param $tag
	 * @return bool
	 */
	protected function isTagNeedsClosingTag($tag)
	{
		return ! in_array($tag, $this->tagsWithoutContent);
	}

    /**
     * This method will generate input type text field
     *
     * @param $name
     * @param string $label
     * @param string $value
     * @param array $options
     * @return $this
     */
    public static function text($name, $label = '', $value = '', $options = [])
    {
        return view('admin::_partials/form_elements/input_text')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options);
    }

    /**
     * @param $name
     * @param string $label
     * @param int $value
     * @param array $options
     * @return $this
     */
    public static function number($name, $label = '', $value = 0, $options = [])
    {
        if (empty($options['id']))
            $options['id'] = uniqid();

        return view('admin::_partials/form_elements/input_number')
            ->with('value', $value)
            ->with('name', $name)
            ->with('label', $label)
            ->with('options', $options);
    }

    /**
     * This method will generate input email
     *
     * @param $name
     * @param string $label
     * @param string $value
     * @param array $options
     * @return $this
     */
    public static function emailField($name, $label = '', $value = '', $options = [])
    {
        return view('admin::_partials/form_elements/input_email')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options);
    }

    public static function emailGroupField($name, $label = '', $value = '', $options = [])
    {
        $values = explode(',', $value);

        AssetManager::addScript(Admin::instance()->router->routeToAsset('js/tag-it.js'));
        AssetManager::addStyle(Admin::instance()->router->routeToAsset('css/jquery.tagit.css'));

        if (empty($options['id']))
            $options['id'] = uniqid();

        return view('admin::_partials/form_elements/input_email_group')
            ->with('name', $name)
            ->with('label', $label)
            ->with('values', $values)
            ->with('options', $options);
    }

    /**
     * This method will generate input type password field
     *
     * @param $name
     * @param string $label
     * @param string $value
     * @param array $options
     * @return $this
     */
    public static function password($name, $label = '', $value = '', $options = [])
    {
        return view('admin::_partials/form_elements/input_password')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options);
    }

    /**
     * This method will generate input type text field
     *
     * @param $name
     * @param string $label
     * @param string $value
     * @param array $options
     * @return $this
     */
    public static function price($name, $label = '', $value = '', $options = [], $currency = '$')
    {
        return view('admin::_partials/form_elements/input_price')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options)
            ->with('currency', $currency);
    }

    /**
     * This method will generate input color
     *
     * @param $name
     * @param string $label
     * @param string $value
     * @param array $options
     * @return $this
     */
    public static function color($name, $label = '', $value = '', $options = [])
    {
        AssetManager::addScript(Admin::instance()->router->routeToAsset('js/bootstrap-colorpicker.js'));
        AssetManager::addStyle(Admin::instance()->router->routeToAsset('css/bootstrap-colorpicker.min.css'));

        if (empty($options['id'])) {
            $options['id'] = uniqid();
        }

        return view('admin::_partials/form_elements/input_color')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options);
    }

    /**
     * @param $name
     * @param $label
     * @param null $value
     * @param array $options
     * @return $this
     */
    public static function checkbox($name, $label, $value = null, array $options = [])
    {
        return view('admin::_partials/form_elements/checkbox')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', (is_null($value)) ? 1 : $value)
            ->with('options', $options);
    }

    /**
     * @param $name
     * @param $label
     * @param array $list
     * @param null $value
     * @param array $options
     * @return $this
     */
    public static function select($name, $label, array $list = [], $value = null, array $options = [])
    {
        return view('admin::_partials/form_elements/select')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $list)
            ->with('id', (!empty($options['id']) ? $options['id'] : $name));
    }

    public static function date($name, $label, $value = null, array $options = [], $dateFormat = DateFormatter::SHORT,
                         $timeFormat = DateFormatter::NONE)
    {
        $value = DateFormatter::format($value, $dateFormat, $timeFormat, 'MM/dd/y');

        AssetManager::addScript(Admin::instance()->router->routeToAsset('js/bootstrap-datepicker.js'));
        AssetManager::addStyle(Admin::instance()->router->routeToAsset('css/datepicker.css'));

        return view('admin::_partials/form_elements/date')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options)
            ->with('format', $dateFormat);
    }

    public static function textarea($name, $label, $value = null, array $options = [])
    {
        $options['id'] = uniqid();

        return view('admin::_partials/form_elements/textarea')
            ->with('name', $name)
            ->with('label', $label)
            ->with('value', $value)
            ->with('options', $options)
            ->with('id', $options['id']);
    }

}